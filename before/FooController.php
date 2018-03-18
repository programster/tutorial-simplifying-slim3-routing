<?php


class FooController extends AbstractSlimController
{
    /**
     * Handle user posting a request to create a foo object.
     * @param array $data
     * @return \Slim\Http\Response
     */
    public function create(array $data) : \Slim\Http\Response
    {
        // pretend we passed the data to the BarModel constructor which would validate the data 
        // before returning the constructed object which we then save to the db.
        $simulatedConstructor = function($postData){
            $randomNumber = rand(0, 1);
            $successful = ($randomNumber === 0);
            
            if (!$successful)
            {
                throw new Exception("Missing required 'name' attribute.", 400);
            }
            
            $fooObject = json_decode(json_encode($postData)); // converting to object form
            return $fooObject;
        };
        
        try
        {
            $fooObject = $simulatedConstructor($data);
            $newResponse = $this->m_response->withJson($fooObject, 200);
        } 
        catch (Exception $ex) 
        {
            $responseData = array('message' => $ex->getMessage());
            $newResponse = $this->m_response->withJson($responseData, $ex->getCode());
        }
        
        return $newResponse;
    }
    
    
    /**
     * Handle a request to get information about a specific foo object
     * @param string $uuid
     * @return \Slim\Http\Response
     */
    public function get(string $uuid) : \Slim\Http\Response
    {
        // pretend that we loaded this from a database or something.
        $fooObject = new stdClass();
        $fooObject->uuid = $uuid;
        $fooObject->name = 'foo1';
        
        // return the fetched object
        $newResponse = $this->m_response->withJson($fooObject, 200);
        return $newResponse;
    }
    
    
    /**
     * Handle a request to fetch all of the foo objects.
     * @return \Slim\Http\Response
     */
    public function getAll() : \Slim\Http\Response
    {
        // pretend that we fetched all thesee objects from the db
        $fooObject1 = new stdClass();
        $fooObject1->uuid = '634adfdb-0513-4c33-bc41-03eb8c0c0ad1';
        $fooObject1->name = 'foo1';
        
        // pretend that we loaded this from a database or something.
        $fooObject2 = new stdClass();
        $fooObject2->uuid = '8a4f12c2-0a8a-40d8-a50f-bcad77cf9622';
        $fooObject2->name = 'foo2';
        
        $fetchedObjects = array(
            $fooObject1,
            $fooObject2
        );
        
        // return the fetched objects.
        $newResponse = $this->m_response->withJson($fetchedObjects, 200);
        return $newResponse;
    }
    
    
    
    /**
     * Handle a request to update an object.
     * @param string $uuid - the uuid of the object to update
     * @param array $data - the attributes to update the object with.
     * @return \Slim\Http\Response
     */
    public function update(string $uuid, array $data) : \Slim\Http\Response
    {
        $randomNumber = rand(0, 1);
        $successful = ($randomNumber === 0);
        
        if ($successful)
        {
            // pretend we updated the object successfully.
            $responseData = array('message' => "Object updated successfully.");
            $newResponse = $this->m_response->withJson($responseData, 200);
        }
        else
        {
            // pretend the user provided an id that does not exist (perhaps was deleted already).
            $responseData = array('message' => "That object does not exist.");
            $newResponse = $this->m_response->withJson($responseData, 404);
        }
        
        return $newResponse;
    }
    
    
    /**
     * Handle the user requesting the deletion of an object.
     * @param string $uuid - the UUID of the object to delete.
     * @return \Slim\Http\Response
     */
    public function delete(string $uuid) : \Slim\Http\Response
    {
        $randomNumber = rand(0, 1);
        $successful = ($randomNumber === 0);
        
        if ($successful)
        {
            // pretend we updated the object successfully.
            $responseData = array('message' => "Object deleted successfully.");
            $newResponse = $this->m_response->withJson($responseData, 200);
        }
        else
        {
            // pretend the user provided an id that does not exist (perhaps was deleted already).
            $responseData = array('message' => "Could not find the object to delete.");
            $newResponse = $this->m_response->withJson($responseData, 404);
        }
        
        return $newResponse;
    }
}
