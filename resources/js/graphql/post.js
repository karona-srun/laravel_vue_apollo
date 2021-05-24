import gql from 'graphql-tag'

export const posts = `
        id
        title
        description
        status
        created_at
        updated_at
        created_by{
            id
            first_name
            last_name
            tel
            email
        }
        updated_by{
            id
            first_name
            last_name
            tel
            email
        }
`;

export const POSTS = gql`
    query{ 
        posts{
            ${posts}
        }
    }`;

export const FETCH_POST = gql`
    query($id: Int!){ 
        post(id: $id){
            ${posts}
        }
    }`;

export const CREATE_POST = gql`
    mutation (
        $title: String!,
        $description: String!
    ) {
        createPost(input: {
        title: $title,
        description: $description
    }) {
        ${posts}
    }}`;

export const UPDATE_POST = gql`
    mutation (
        $id: Int!,
        $title: String!
        $description: String!
        $status: Boolean!
    ) {
        updatePost(input: {
        id: $id,
        title: $title,
        description: $description
        status: $status
    }) {
        ${posts}
    }}`;

export const DELETE_POST = gql`
    mutation ($id: Int!) {
        deletePost(input: {
        id: $id
    }) {
        ${posts}
    }}`;
    