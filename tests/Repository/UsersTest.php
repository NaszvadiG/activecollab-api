<?php
/**
 * Created by PhpStorm.
 * User: aschempp
 * Date: 22.06.14
 * Time: 17:08
 */

namespace Terminal42\ActiveCollabApi\Repository;

use Terminal42\ActiveCollabApi\Model\User;

class UsersTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Terminal42\ActiveCollabApi\ApiClient|\PHPUnit_Framework_MockObject_MockObject $api
     */
    protected $api;


    public function setup()
    {
        $this->api = $this->getMock('\Terminal42\ActiveCollabApi\ApiClient', array('sendRequest'), array(), '', false);
    }

    public function testRepository()
    {
        $repository = $this->api->usersForCompany(1);

        $this->assertInstanceOf('\Terminal42\ActiveCollabApi\Repository\Users', $repository);
        $this->assertEquals(1, $repository->getCompanyId());
    }

    public function testFindAll()
    {
        $data = (object) array(
            'id'    => 1,
            'name'  => 'test'
        );

        $this->api->expects($this->any())
            ->method('sendRequest')
            ->will($this->returnValue(array($data)));

        $this->assertEquals(
            array(
                new User($data, $this->api->usersForCompany(1))
            ),
            $this->api->usersForCompany(1)->findAll()
        );
    }
}
 