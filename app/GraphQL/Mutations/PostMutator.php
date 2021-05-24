<?php

namespace App\GraphQL\Mutations;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use App\Models\Post;

class PostMutator
{
    
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver
    }

    /**
     * Return a value for the field.
     *
     * @param  null  $rootValue
     * @param  mixed[]  $args
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context 
     * @return mixed
     */
    public function create($rootValue, array $args, GraphQLContext $context)
    {
        $model = new Post();
        $args['status'] = true;
        $args['created_by'] = 2;
        $args['updated_by'] = 2;
        $model->fill($args)->save();
        return $model;
    }

    /**
     * Return a value for the field.
     *
     * @param  null  $rootValue
     * @param  mixed[]  $args
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context 
     * @return mixed
     */
    public function update($rootValue, array $args, GraphQLContext $context)
    {
        $model = Post::find($args['id']);
        $args['created_by'] = 2;
        $args['updated_by'] = 2;
        $model->fill($args)->save();
        return $model;
    }

    /**
     * Return a value for the field.
     *
     * @param  null  $rootValue
     * @param  mixed[]  $args
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context 
     * @return mixed
     */
    public function delete($rootValue, array $args, GraphQLContext $context)
    {
        $model = Post::find($args['id']);
        $model->delete();
        return $model;
    }
}
