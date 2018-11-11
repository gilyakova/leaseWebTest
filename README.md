Structure
- /app/http/Controllers/ - work with API requests
- /app/Models/ - general DB models
- /app/Servers/ - package for server object
				    /Models/ - DB model
            /Requests/ - Form validations
           	/Resources/ - Preparating data to API answer
            /Services/ - Busines logic
- /app/Modules/ - package for module object
        		/Models/ - DB model
            /Requests/ - Form validations
            /Resources/ - Preparating data to API answer
            /Services/ - Busines logic
- /database/migrations/ - DB scheme for migrating
- /resources/js/ - front part of project
- /routes/

Notes
- Modules type - for scalability better to create a new table for this, (think for test task enough to use 'enum' for that)
- The same way brand - better to use another table with an opportunity to manage it (CRUD for that)
- About price - by logic better to make dependence to count of modules (each module should increase price)
- Test task requirements do not contain anything about users (registration and authorization) So here I used default user and use oauth2 protocol for using a token (of course here need to make CRUD for users and everything with that, but for test task just default user and default token)
- In requirements, I see that server should contain minimum 1 module. I did next for that: if think about scalability so server object will contain a lot of different dependencies and requirements minimum 1 module is not alone. Because of it, I added column "valid" which means 1 - all checks and dependencies are valid, and 0 - not valid (in front part invalid servers are red). Of course, we can check all of it each request but it is not optimized, better to check in when something is changing.
- In requirements nothing about deleting, so, I added 'deleted' column for the scalability, but now it is just used in getting list functions
