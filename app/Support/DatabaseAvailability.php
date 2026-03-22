<?php

namespace App\Support;

use Closure;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use PDOException;
use Throwable;

class DatabaseAvailability
{
    /**
     * Run a callback and only fall back for environment-level database failures.
     */
    public static function fallback(Closure $callback, mixed $fallback): mixed
    {
        if (! self::isReachable()) {
            return value($fallback);
        }

        try {
            return $callback();
        } catch (Throwable $exception) {
            if (! self::causedByUnavailableDatabase($exception)) {
                throw $exception;
            }

            report($exception);

            return value($fallback, $exception);
        }
    }

    public static function causedByUnavailableDatabase(Throwable $exception): bool
    {
        $signals = [
            'could not find driver',
            'no connection could be made',
            'actively refused it',
            'connection refused',
            'server has gone away',
            'unknown database',
            'base table or view not found',
            'no such table',
        ];

        while ($exception) {
            if ($exception instanceof PDOException || $exception instanceof QueryException) {
                $code = (string) $exception->getCode();
                $message = Str::lower($exception->getMessage());

                if (in_array($code, ['14', '2002', '1049', '1146'], true)) {
                    return true;
                }

                foreach ($signals as $signal) {
                    if (str_contains($message, $signal)) {
                        return true;
                    }
                }
            }

            $exception = $exception->getPrevious();
        }

        return false;
    }

    public static function isReachable(): bool
    {
        $defaultConnection = Config::get('database.default');

        if (! is_string($defaultConnection)) {
            return false;
        }

        if ($defaultConnection === 'sqlite') {
            $databasePath = Config::get('database.connections.sqlite.database');

            return extension_loaded('pdo_sqlite')
                && is_string($databasePath)
                && file_exists($databasePath);
        }

        if (! in_array($defaultConnection, ['mysql', 'mariadb'], true)) {
            return true;
        }

        $host = (string) Config::get("database.connections.$defaultConnection.host", '127.0.0.1');
        $port = (int) Config::get("database.connections.$defaultConnection.port", 3306);
        $timeout = max((float) env('DB_CONNECT_TIMEOUT', 2), 0.5);

        $socket = @fsockopen($host, $port, $errorNumber, $errorMessage, $timeout);

        if (! $socket) {
            return false;
        }

        fclose($socket);

        return true;
    }

    public static function warningMessage(): string
    {
        return 'Database is unavailable on this machine right now, so product and basket data are being shown in limited local mode.';
    }
}
