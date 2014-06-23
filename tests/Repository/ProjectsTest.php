<?php
/**
 * Created by PhpStorm.
 * User: aschempp
 * Date: 22.06.14
 * Time: 17:08
 */

namespace Terminal42\ActiveCollabApi\Repository;

use Terminal42\ActiveCollabApi\Model\Project;

class ProjectsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Terminal42\ActiveCollabApi\ApiClient|\PHPUnit_Framework_MockObject_MockObject $api
     */
    protected $api;


    public function setup()
    {
        $this->api = $this->getMock('\Terminal42\ActiveCollabApi\ApiClient', array('get'), array(), '', false);
    }

    public function testRepository()
    {
        $this->assertInstanceOf(
            '\Terminal42\ActiveCollabApi\Repository\Projects',
            $this->api->projects()
        );
    }

    public function testFindAll()
    {
        $data = (object) array(
            'id'    => 1,
            'name'  => 'test'
        );

        $this->api->expects($this->once())
            ->method('get')
            ->with($this->equalTo('projects'))
            ->will($this->returnValue(array($data)));

        $this->assertEquals(
            array(
                new Project($data, $this->api->projects())
            ),
            $this->api->projects()->findAll()
        );
    }

    public function testFindArchived()
    {
        $data = (object) array(
            'id'    => 1,
            'name'  => 'test'
        );

        $this->api->expects($this->once())
            ->method('get')
            ->with($this->equalTo('projects/archive'))
            ->will($this->returnValue(array($data)));

        $this->assertEquals(
            array(
                new Project($data, $this->api->projects())
            ),
            $this->api->projects()->findArchived()
        );
    }
}
 