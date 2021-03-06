<?php
namespace Consolidation\SiteAlias;

use PHPUnit\Framework\TestCase;

class SiteAliasFileDiscoveryTest extends TestCase
{
    use FixtureFactory;
    use FunctionUtils;

    function setUp()
    {
        $this->sut = new SiteAliasFileDiscovery();
    }

    public function testSearchForSingleAliasFile()
    {
        $this->sut->addSearchLocation($this->fixturesDir() . '/sitealiases/sites');

        $path = $this->sut->findSingleSiteAliasFile('single');
        $this->assertLocation('sites', $path);
        $this->assertBasename('single.site.yml', $path);
    }

    public function testSearchForMissingSingleAliasFile()
    {
        $this->sut->addSearchLocation($this->fixturesDir() . '/sitealiases/sites');

        $path = $this->sut->findSingleSiteAliasFile('missing');
        $this->assertFalse($path);
    }

    public function testFindAllLegacyAliasFiles()
    {
        $this->sut->addSearchLocation($this->fixturesDir() . '/sitealiases/legacy');

        $result = $this->sut->findAllLegacyAliasFiles();
        $paths = $this->simplifyToBasenamesWithLocation($result);
        $this->assertEquals('legacy/aliases.drushrc.php,legacy/cc.aliases.drushrc.php,legacy/one.alias.drushrc.php,legacy/pantheon.aliases.drushrc.php,legacy/server.aliases.drushrc.php', implode(',', $paths));
    }

    protected function assertLocation($expected, $path)
    {
        $this->assertEquals($expected, basename(dirname($path)));
    }

    protected function assertBasename($expected, $path)
    {
        $this->assertEquals($expected, basename($path));
    }

    protected function simplifyToBasenamesWithLocation($result)
    {
        if (!is_array($result)) {
            return $result;
        }

        $result = array_map(
            function ($item) {
                return basename(dirname($item)) . '/' . basename($item);
            }
            ,
            $result
        );

        sort($result);

        return $result;
    }
}
