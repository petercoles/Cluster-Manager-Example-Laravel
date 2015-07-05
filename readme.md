## Cluster Manager Example

### Introduction ###

This application demonstrates how to use the PHP Cluster Manager package. It's designed to be paired with a Cluster Worker Example.

The underlying idea is that this cluster manager application monitors a queue. When it spots jobs appearing there, it powers up worker servers to deal with them. When the job queue is empty the cluster manager powers the workers down.

This package contains the software needed to run a single page web site, generate test data, receive data files, parse them and pass the results to an IronMQ queue, monitor the queue, power worker servers up and down as neeeded, store data int eh database and files in the filesystem.

This example is written in Laravel.

### Requirements ###

All dependencies for this application are specified in the project's composer.json file and are loaded thus. The only other dependency is an image for the worker server, ready to be powered up as needed.

For this example, I've used Iron MQ as the queue provider, the credentials for which are tucked away in my Laravel .env file, so get your own (they have a "lite" option which is free for up to a million api calls, which should keep you going for a while).

I've used Digital Ocean as the server provider. They're free, but they're at the least exepnsive end, and their API is easy to work with (that that's all taken care of by the PHP Cluster Manager package).

### Installation ###

Create a server - this example sort of expects a 1GB, Ubuntu server in Digital Ocean's LON1 location, and I'm rather partial to Nginx, so these instructions will assume that too. This will get a bit more flexible later on, especially as that centre doesn't seem to be their most stable.

Decide where you're going to put your application and clone it there from <aha, I need to make this public>. Then edit the nginx default config file to point there. Well, not exactly there, actually the index.php in the Laravel public folder.

I guess you could access the site from your server's IP address, though I prefer to use a (sub)domain. Either way your IronMQ tokens and Digit Ocean token will need to go in a .env file (I guess I need to document how that's laid out).