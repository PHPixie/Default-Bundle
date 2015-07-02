<?php

namespace PHPixie\Tests;

/**
 * @coversDefaultClass \PHPixie\DefaultBundle
 */
class DefaultBundleTest extends \PHPixie\Test\Testcase
{
    protected $bundleClass  = '\PHPixie\DefaultBundle';
    protected $builderClass = '\PHPixie\DefaultBundle\Builder';
    
    protected $components;
    
    protected $bundle;
    
    protected $builder;
    
    public function setUp()
    {
        $this->components = $this->quickMock('\PHPixie\Framework\Components');
        $this->builder = $this->quickMock($this->builderClass);
        $this->bundle = $this->bundleMock(array('name'));
    }
    
    /**
     * @covers ::__construct
     * @covers ::<protected>
     */
    public function testConstruct()
    {
        
    }
    
    /**
     * @covers ::httpProcessor
     * @covers ::<protected>
     */
    public function testHttpProcessors()
    {
        $this->builderMethodTest('httpProcessor', '\PHPixie\Processors\Processor');
    }
    
    /**
     * @covers ::ormWrappers
     * @covers ::<protected>
     */
    public function testOrmWrappers()
    {
        $this->builderMethodTest('ormWrappers', '\PHPixie\ORM\Wrappers');
    }
    
    /**
     * @covers ::routeResolver
     * @covers ::<protected>
     */
    public function testRouteResolver()
    {
        $this->builderMethodTest('routeResolver', '\PHPixie\Route\Resolvers\Resolver');
    }
    
    /**
     * @covers ::templateLocator
     * @covers ::<protected>
     */
    public function testTemplateLocator()
    {
        $this->builderMethodTest('templateLocator', '\PHPixie\Filesystem\Locators\Locator');
    }
    
    /**
     * @covers ::webRoot
     * @covers ::<protected>
     */
    public function testWebRoot()
    {
        $this->builderMethodTest('webRoot', '\PHPixie\Filesystem\Root');
    }
    
    protected function builderMethodTest($method, $class)
    {
        $instance = $this->quickMock($class);
        $this->method($this->builder, $method, $instance, array(), 0);
        $this->assertSame($instance, $this->bundle->$method());
    }
    
    protected function bundleMock($methods = array())
    {
        $methods[]= 'buildbuilder';
        
        $bundle = $this->getMockBuilder($this->bundleClass)
            ->setMethods($methods)
            ->disableOriginalConstructor()
            ->getMock();
        
        
        $this->method($bundle, 'buildBuilder', $this->builder, array(
            $this->components
        ), 0);
        
        $bundle->__construct(
            $this->components
        );
        
        return $bundle;
    }
}