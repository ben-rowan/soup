# soup

An experiment in creating applications in which code has no fixed locality.

## Brain Dump

* Each Object type has a URI
* Each Object can interact with other objects (collaborators) by passing a message through a Router. This Router
will handle the process of passing this message on to the correct collaborator.
* Messages can be passed locally or over a network
* Code can be held locally or streamed over a network
* The system will assume the code is held locally by default. The location can then be configured to change this.
* The system config will allow you to define pipelines. This means that you can say Object A must always be called
before B and it's output passed to B. The same for B follows A. This means that you can easily modify the behaviour
of an application without changing any existing code.
* The system config will allow you to use different Classes that define the same interface based on the context such
as caller. This means we have some of the power of DI built in.
* Massages will be made up of value Objects. These value objects will be self validating and ensure they are always in
a valid state. This centralises the validation logic.
* Ideally the user should be provided with a set of universal value objects to speed up development.
* The massage itself will be an array like object that contains value Objects or 'Sections'. An Object can then choose
to either throw and error if it hasn't been provided with the correct sections, opt not to complete it's processing or
something else.
* When streaming code it will include a TTL so that it can be cached. This TTL will need to be set and synchronised at
a 'Module' level to ensure that all the code in the module is updated at the same time.
* File versions will be determined by hashing the file (without comments and white space). This means that developers
don't need to be concerned with defining this themselves (obviously overall versions can still be tracked in version
control).
* Once the TT has been hit send the request for the latest version of the file, check it's hash. If the hash is the same
return this info. If it's changed send the latest version of the code.

## Expected Benefits

* With a simple config change and no code changes sections of your application can be moved between servers as required.
The moved section of your application could also be replicated multiple times with the Router handling traffic to the
servers to begin with as a round robin.
* Streaming code means the following:
    * You can process huge volumes of data without sending the data away from your server. This is a huge performance
    improvement.
    * Code is cachable but in general data is not. This means that by streaming the code to the data you can massively
    reduce API calls and data sending.
    * This is also great for data privacy. This would be especially true if the received code was sandboxed.
    * There are obviously security implications here that would need to be addressed.