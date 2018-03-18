<?php


class BarController extends AbstractSlimController
{
    /**
     * Handle user posting a request to create a bar object.
     * @param array $data
     * @return \Slim\Http\Response
     */
    public function create(array $data) : \Slim\Http\Response
    {
        // pretend we passed the data to the BarModel constructor which would validate the data 
        // before returning the constructed object which we then save to the db.
        $simulatedConstructor = function($postData){
            if (!isset($postData['name']))
            {
                throw new Exception("Missing required 'name' attribute.", 400);
            }
            
            $barObject = json_decode(json_encode($postData)); // converting to object form
            return $barObject;
        };
        
        try
        {
            $barObject = $simulatedConstructor($data);
            $newResponse = $this->m_response->withJson($barObject, 200);
        } 
        catch (Exception $ex) 
        {
            $responseData = array('message' => $ex->getMessage());
            $newResponse = $this->m_response->withJson($responseData, $ex->getCode());
        }
        
        return $newResponse;
    }
    
    
    /**
     * Handle a request to get information about a specific bar object
     * @param string $uuid
     * @return \Slim\Http\Response
     */
    public function get(string $uuid) : \Slim\Http\Response
    {
        // pretend that we loaded this from a database or something.
        $barObject = new stdClass();
        $barObject->uuid = $uuid;
        $barObject->name = 'bar1';
        
        // return the fetched object
        $newResponse = $this->m_response->withJson($barObject, 200);
        return $newResponse;
    }
    
    
    /**
     * Handle a request to fetch all of the bar objects.
     * @return \Slim\Http\Response
     */
    public function getAll() : \Slim\Http\Response
    {
        // pretend that we fetched all thesee objects from the db
        $barObject1 = new stdClass();
        $barObject1->uuid = '634adfdb-0513-4c33-bc41-03eb8c0c0ad1';
        $barObject1->name = 'bar1';
        
        // pretend that we loaded this from a database or something.
        $barObject2 = new stdClass();
        $barObject2->uuid = '8a4f12c2-0a8a-40d8-a50f-bcad77cf9622';
        $barObject2->name = 'bar2';
        
        $fetchedObjects = array(
            $barObject1,
            $barObject2
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
