# Lesbotoč APIs

## About

These API scripts are designed to allow users to manage events, contacts, images and signupforms through a set of RESTful APIs.
The script provides the ability to create, read, update, and delete events and contacts, to add and delete images and to save event signup information in a database.

## Tech Stack

This API script is built using PHP and uses MySQL as the database.

## How to run the project

To run this project, you will need to have PHP and MySQL installed on your system. Here are the steps to get started:

1. Clone this repository to your local machine:  
   `git clone https://github.com/queuing4oranges/lesbotoc-backend-api.git`

2. Navigate to the project directory:  
   `cd your-repo`

3. Set up your database and database tables.

4. Configure the database connection by updating the corresponding values.

5. Start the server by running the following command:  
   `php -S localhost:8000`

6. You should now be able to access the APIs at:
   `http://localhost:8000/api/{endpoint}`

## API Endpoints

Here are the available endpoints for this API script:  
<br>

### Events

<table>
   <tr>
       <td>
           <b>Route
       </td>
       <td>
           <b>Functionality
       </td>
   </tr>
    <tr>
       <td>
           GET   /api/events/read
       </td>
       <td>
           Retrieve a list of all events
       </td>
    </tr>
        <tr>
       <td>
           GET   /api/events/single_read{id}
       </td>
       <td>
           Retrieve a single event
       </td>
    </tr>
        <tr>
       <td>
           POST api/events/create
       </td>
       <td>
           Create an event
       </td>
    </tr>
        <tr>
       <td>
           PUT api/events/update{id}
       </td>
       <td>
           Update an event
       </td>
    </tr>
        <tr>
       <td>
          DELETE api/events/delete{id}
       </td>
       <td>
           Delete an event
       </td>
    </tr>
</table>

<br>

### Contacts

<table>
   <tr>
       <td>
           <b>Route
       </td>
       <td>
           <b>Functionality
       </td>
   </tr>
    <tr>
       <td>
           GET   /api/contacts/read
       </td>
       <td>
           Retrieve a list of all contacts
       </td>
    </tr>
        <tr>
       <td>
           GET   /api/events/single_read{id}
       </td>
       <td>
           Retrieve a single contact
       </td>
    </tr>
        <tr>
       <td>
           POST api/contacts/create
       </td>
       <td>
           Create a contact
       </td>
    </tr>
        <tr>
       <td>
           PUT api/contacts/update{id}
       </td>
       <td>
           Update a contact
       </td>
    </tr>
        <tr>
       <td>
          DELETE api/contacts/delete{id}
       </td>
       <td>
           Delete a contact
       </td>
    </tr>
</table>

<br>

### Images

<table>
   <tr>
       <td>
           <b>Route
       </td>
       <td>
           <b>Functionality
       </td>
   </tr>
    <tr>
       <td>
           GET   /api/images/read
       </td>
       <td>
           Retrieve a list of all images
       </td>
    </tr>
        <tr>
       <td>
           GET   /api/images/single_pic{id}
       </td>
       <td>
           Retrieve a single image
       </td>
    </tr>
        <tr>
       <td>
           POST api/contacts/upload
       </td>
       <td>
           Upload an image
       </td>
        <tr>
       <td>
          DELETE api/images/delete{id}
       </td>
       <td>
           Delete an image
       </td>
    </tr>
</table>  
<br>

### Speed-Dating Signup Form

<table>
   <tr>
       <td>
           <b>Route
       </td>
       <td>
           <b>Functionality
       </td>
   </tr>
    <tr>
       <td>
           GET   /api/speeddating/read
       </td>
       <td>
           Retrieve a list of all speed dating participants
       </td>
        <tr>
       <td>
           POST api/speeddating/create
       </td>
       <td>
           Create a speed dating participant
       </td>
        <tr>
       <td>
          DELETE api/speeddating/delete{id}
       </td>
       <td>
           Delete a speed dating participant
       </td>
    </tr>
</table>
