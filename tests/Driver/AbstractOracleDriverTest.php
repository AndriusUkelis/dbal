<?php

declare(strict_types=1);

namespace Doctrine\DBAL\Tests\Driver;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Driver;
use Doctrine\DBAL\Driver\AbstractOracleDriver;
use Doctrine\DBAL\Driver\API\ExceptionConverter;
use Doctrine\DBAL\Driver\API\OCI;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Platforms\OraclePlatform;
use Doctrine\DBAL\Schema\AbstractSchemaManager;
use Doctrine\DBAL\Schema\OracleSchemaManager;

/** @extends AbstractDriverTest<OraclePlatform> */
class AbstractOracleDriverTest extends AbstractDriverTest
{
    protected function createDriver(): Driver
    {
        return $this->getMockForAbstractClass(AbstractOracleDriver::class);
    }

    protected function createPlatform(): AbstractPlatform
    {
        return new OraclePlatform();
    }

    protected function createSchemaManager(Connection $connection): AbstractSchemaManager
    {
        return new OracleSchemaManager(
            $connection,
            $this->createPlatform(),
        );
    }

    protected function createExceptionConverter(): ExceptionConverter
    {
        return new OCI\ExceptionConverter();
    }

    public function testThrowsExceptionOnCreatingDatabasePlatformsForInvalidVersion(): void
    {
        self::markTestSkipped('Oracle drivers do not use server version to instantiate platform');
    }

    /**
     * {@inheritDoc}
     */
    public static function platformVersionProvider(): array
    {
        self::markTestSkipped('Oracle drivers use one platform implementation for all server versions');
    }
}
