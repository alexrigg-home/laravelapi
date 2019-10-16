# laravelapi
very simple RESTFUL api written in Laravel.

call: /index.php/api/register
HTTP: POST
Header:
accept application/json
content-type applciation/json
body:
{
	"name": "bob",
	"email":"bob@testing.com",
	"password":"mypassword",
	"password_confirmation":"mypassword"
}

will result in
{
    "data": {
        "name": "bob",
        "email": "bob@testing.com",
        "updated_at": "2019-09-26 15:32:11",
        "created_at": "2019-09-26 15:32:11",
        "id": 14,
        "api_token": "XXXXXXXXXXXXXXXXXXX"
    }
}

call: /index.php/api/articles
HTTP: GET
Header:
accept application/json
content-type applciation/json
Authorization: Bearer XXXXXXXXXXXXXXXXXXX

will result in
[
    {
        "id": 1,
        "title": "Qui est eveniet odit quia.",
        "body": "Repellat sed perspiciatis eum consequatur expedita modi. In deleniti nihil error dolorem nihil quibusdam porro autem. Iure at id corrupti cupiditate fugiat laborum placeat. Tempora mollitia quo in expedita aliquid accusantium dolorum.",
        "created_at": "2019-09-25 15:30:38",
        "updated_at": "2019-09-25 15:30:38"
    },
    ....
]

call: /index.php/api/articles/1
HTTP: DELETE
Header:
accept application/json
content-type applciation/json
Authorization: Bearer XXXXXXXXXXXXXXXXXXX

will result in (204)

call: /index.php/api/articles
HTTP: POST
Header:
accept application/json
content-type applciation/json
Authorization: Bearer XXXXXXXXXXXXXXXXXXX
body:
{
    "title": "Example.",
    "body": "Example Repudiandae ab explicabo earum aperiam nihil facere. Qui dignissimos consectetur beatae cum nihil. Possimus sint reprehenderit ut excepturi dolores nostrum. Repellat molestias repudiandae blanditiis."
}

will result in
{
    "title": "Example.",
    "body": "Example Repudiandae ab explicabo earum aperiam nihil facere. Qui dignissimos consectetur beatae cum nihil. Possimus sint reprehenderit ut excepturi dolores nostrum. Repellat molestias repudiandae blanditiis.",
    "updated_at": "2019-09-26 15:55:41",
    "created_at": "2019-09-26 15:55:41",
    "id": 52
}

