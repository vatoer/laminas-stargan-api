<?php
namespace Status\V1\Rest\Status;

use StatusLib\MapperInterface;
use Laminas\ApiTools\ApiProblem\ApiProblem;
use Laminas\ApiTools\Rest\AbstractResourceListener;


class StatusResource extends AbstractResourceListener
{
    protected $mapper;

    public function __construct(MapperInterface $mapper){
        $this->mapper = $mapper;
    }

    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return Entity|mixed
     */
    public function create($data)
    {
        return $this->mapper->create($data);
        //return new ApiProblem(405, 'The POST method has not been defined');
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->mapper->delete($id);
        //return new ApiProblem(405, 'The DELETE method has not been defined for individual resources');
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return Entity|mixed
     */
    public function fetch($id)
    {
        return $this->mapper->fetch($id);
        //return new ApiProblem(405, 'The GET method has not been defined for individual resources');
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return Collection|mixed
     */
    public function fetchAll($params = [])
    {
        return $this->mapper->fetchAll();
        //return new ApiProblem(405, 'The GET method has not been defined for collections');
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return Entity|mixed
     */
    public function patch($id, $data)
    {
        return $this->mapper->update($id,$data);
        //return new ApiProblem(405, 'The PATCH method has not been defined for individual resources');
    }

    /**
     * Patch (partial in-place update) a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patchList($data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for collections');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return Entity|mixed
     */
    public function update($id, $data)
    {
        return $this->mapper->update($id,$data);
        //return new ApiProblem(405, 'The PUT method has not been defined for individual resources');
    }
}
