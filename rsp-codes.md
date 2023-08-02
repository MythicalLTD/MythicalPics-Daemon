| Status Code | Message           | Description                                                                                   |
|-------------|-------------------|-----------------------------------------------------------------------------------------------|
| 200         | OK                | The request was successful.                                                                   |
| 201         | Created           | The request resulted in the creation of a new resource.                                      |
| 204         | No Content        | The server successfully processed the request, but there is no content to send in the response. |
| 400         | Bad Request       | The server cannot understand the request due to a client error.                              |
| 401         | Unauthorized      | The request requires user authentication or the provided credentials are invalid.             |
| 403         | Forbidden         | The server understood the request, but it refuses to authorize it.                            |
| 404         | Not Found         | The requested resource could not be found on the server.                                     |
| 500         | Internal Server Error | The server encountered a situation it doesn't know how to handle.                         |
| 503         | Service Unavailable   | The server is not ready to handle the request.                                               |