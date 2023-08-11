# WP Import

Collection of code resources used when writing imports and data migrations for WordPress.

This isn't a module that is "ready to go" or "plug and play".
It provides the absolute base structure that can be extended to build imports into WordPress.

Code examples take an Object-Oriented approach, particular for use with The Code Company's WPMVC framework.

### Namespaces/Directories

#### Core

Foundational assets.

Useful for any import process but also very simple to provide flexibility.

#### Base

Base assets.

Provide additional structure, ideally used by all implementations.

Very simplistic to allow for greater flexibility.

#### Common

Common assets and structure.

Provide more concrete implementation but still aiming to be generalised.

The structure here is to exemplify what is possible.

You may need to alter the structure here to suit your project needs.

### Structure and Patterns

#### Core Classes

Essentially there are two main classes used for importing:

1. Import Process
2. Importer

##### Import Process

This class manages an overall import process.

It is responsible for managing the retrieval of data from an external source and insertion of said data to a destination 
dataset, likely using an `Importer` class.

Normally an import process is model-specific and only be concerned with importing one type of model (or at least data from one API endpoint, file, etc.).

E.g. A `PostImportProcess` that only imports posts and related data from an API endpoint (`GET API/posts`).
It may use both a `PostImporter` to insert posts and a `CategoryImporter` to import categories for a given post.
If a separate `GET API/categories` endpoint exists, though, you would use a separate `CategoryImportProcess` to connect
to and import from this endpoint.

An import process may be triggered by running a WP CLI command, hitting a REST API endpoint or running a cron or
scheduled action. The idea is that a single import process could be invoked in many ways but still use the same logic.
E.g. a `ImportPostsCommand` and `ImportPostsCronController` could both instantiate, configure and trigger a
`PostImportProcess`.

##### Importer

This class manages the actual process of importing the specific data for a model into a destination dataset.

You pass it some data from an external source (e.g. an API) and it will insert that into the destination data source 
(e.g. WordPress database) and provide some indication of what happened.

The actual implementation is up to you - WordPress function, custom SQL, etc.

Normally an importer is model-specific and should only be concerned with inserting data for specific model into the 
destination data source.

E.g. A `PostImporter` would only import posts. If you also needed to import categories for the post, you would 
instantiate and use a separate `CategoryImporter` class to accomplish this.

#### Patterns

Some patterns used here:

##### Observer Pattern

Objects allow logic to be run at certain points by other objects by notifying them when specific events occur.

The observer pattern is a software design pattern in which an object, named the subject, maintains a list of its 
dependents, called observers, and notifies them automatically of any state changes, usually by calling one of their
methods.

`ImportProcess` and `Importer` classes notify their observers before/during/after key events so that additional logic
can be run.

E.g.:

- A logger may wish to log the outcome of an `Importer` importing a model to CLI
- An CLI command may want to free up memory after an `ImportProcess` has imported a batch of models
- An `ImportProcess` may want to import categories for a post after an `Importer` has inserted/updated it in WordPress, but before it has its taxonomy relationships set

Following this pattern is a bit easier to follow than trying to chase down WordPress hooks and filters.

##### Template Method Pattern

Base classes provide empty method stubs to be filled in by child classes.

The template method is a method in a superclass, usually an abstract superclass, and defines the skeleton of an 
operation in terms of a number of high-level steps.

##### Single Exit Point Principle

Most methods are written with a single return statement for better readability.

## TODO

- Top level structure
- Composer support for autoload
- Code examples list
