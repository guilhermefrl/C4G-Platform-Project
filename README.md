# C4G-Platform-Project

## Objective

The objective of this project was to implement a platform and database to manage the services of C4G to the community. The database will store information about the members of C4G and other external users that are linked to the infrastructure. Also, stores information about the available resources, their quantity, the institutions, services and group work.

## About C4G 
The Colaboratório para as Geociências (C4G) is an infrastructure dedicated to Solid Earth Sciences which brings together 58 laboratories and 15 institutions in Portugal. More information on the website: https://www.c4g-pt.eu/pt/.

## Relation between the diferent data

#### Resources

* May have different characteristics depending on the resource;
* Availability and costs must be checked.

#### Services 

* Are supervised by working groups;
* Always have a responsible;
* They always have a user who requires it;
* Registration of each service with a detailed list and to whom it was provided.

#### Institutions

* They can be public, private or an individual user.

#### Group work

* Characterize the various types of services available.

#### Users

* Administrators
    * Can add or remove services and equipment;
    * They are mandatory members of C4G, therefore they also have all their rights;
    * They can also add or remove users (with the respective user type defined here).
* C4G Members
    * May or may not belong to partner institutions;
    * May or may not belong to research groups.
* Other users 
    * Can view all available services.

## Bootstrap
Was used Bootstrap to make the front-end more presentable.

**Bootstrap CDN :**

    CSS : https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css
    JS : https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js
