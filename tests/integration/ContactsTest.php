<?php declare(strict_types=1);

namespace Tests\integration;

class ContactsTest extends TestCase
{
    private static $id;

    public function testCreateContacts()
    {
        $params = [
                '' => '',
                'name' => 'aaa',
		'email' => 'aaa',
		'subject' => 'aaa',
		'message' => 'aaa',
        ];
        $app = $this->getAppInstance();
        $request = $this->createRequest('POST', '/contacts');
        $request = $request->withParsedBody($params);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        self::$id = json_decode($result)->id;

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetContactss()
    {
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/contacts');
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetContacts()
    {
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/contacts/' . self::$id);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetContactsNotFound()
    {
        $app = $this->getAppInstance();
        $request = $this->createRequest('GET', '/contacts/123456789');
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertStringContainsString('error', $result);
    }

    public function testUpdateContacts()
    {
        $app = $this->getAppInstance();
        $request = $this->createRequest('PUT', '/contacts/' . self::$id);
        $request = $request->withParsedBody(['' => '']);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testDeleteContacts()
    {
        $app = $this->getAppInstance();
        $request = $this->createRequest('DELETE', '/contacts/' . self::$id);
        $response = $app->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(204, $response->getStatusCode());
        $this->assertStringNotContainsString('error', $result);
    }
}
