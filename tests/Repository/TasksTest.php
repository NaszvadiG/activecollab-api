<?php
/**
 * Created by PhpStorm.
 * User: aschempp
 * Date: 22.06.14
 * Time: 17:08
 */

namespace Terminal42\ActiveCollabApi\Repository;

use Terminal42\ActiveCollabApi\Model\Task;

class TasksTest extends \PHPUnit_Framework_TestCase
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
        $repository = $this->api->tasksForProject('project_id');

        $this->assertInstanceOf('\Terminal42\ActiveCollabApi\Repository\Tasks', $repository);
        $this->assertEquals('projects/project_id', $repository->getContext());
    }

    public function testFindAll()
    {
        $data = (object) array(
            'id'    => 1,
            'name'  => 'test'
        );

        $this->api->expects($this->once())
            ->method('get')
            ->with($this->equalTo('projects/project_id/tasks'))
            ->will($this->returnValue(array($data)));

        $this->assertEquals(
            array(
                new Task($data, $this->api->tasksForProject('project_id'))
            ),
            $this->api->tasksForProject('project_id')->findAll()
        );
    }
}
 