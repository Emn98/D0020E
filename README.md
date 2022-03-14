# D0020E Frontend for administrating attributes for secure access to data 
## About the project 
The goal of our project is to create a functioning frontend for administering attributes with NGAC. The frontend should serve to simplify administration of attributes with NGAC, which is a process that can become complicated quickly in non-trivial systems. Our front end should therefore be intuitive and easy to use, such that an administrator can manage attributes without deeper knowledge of the NGAC server and other tools used in our implementation.

NGAC is a flexible framework which follows an attribute-based access control model. NGAC is not limited to object attributes, it can also use conditions like location, time or situations. NGAC builds on the assumption that it's possible to represent the system you want to guard as a graph that views both organizational structure and the resources you want to protect in a meaningful way.

## Built with
- php
- html
- css
- javascript

## Getting started
This is an example of how you may give instructions on setting up your project locally. To get a local copy up and running follow these simple example steps.

### Prerequisites
Download and setup the open group implementation of ngac https://github.com/tog-rtd/tog-ngac-crosscpp. Also you need to change the ***std_resp_prefix*** rule in the file paapi.pl to
```
std_resp_prefix :-
	(   param:jsonresp(on)
	->  cors_enable,
	    format('Content-type: application/json~n~n')
	    
	;   cors_enable,
	    format('Content-type: text/plain~n~n')
	    
	).
```
then add the following two modules to ***server.pl***
```
:- use_module(library(http/http_cors)).
:- use_module(library(settings)).
```
and finally you have to add this line in ***server.pl***
```
:- set_setting(http:cors, [*]).
```
This will allow any webbrowser to communicate with the ngac policy administration api.

If it is desired to use our test page as is, you must download our implementations of ***PEP-RAP*** located in ***resources*** and replace the directory with the same name in ngac. But note that our implementations are limited and thus it can be wiser to created you'r own implementations.

You will need to set up a server using mysql and phpmyadmin.

### Installation
To be able to start the ***ngac-server***, the ngac implementation must be compiled. Navigate to to you'r ngac directory and enter the following 
```
swipl -v -o ngac-server -g ngac-srver -c ngac.pl
```

Download the ***src*** directory and place the files in the directory that you'r server uses for webclient. Create a empty database named website in phpmyadmin. Download the database file ***website.sql*** located in ***resources*** and import it in you'r phpmyadmin website databasse. Set your phpmyadmin username to ***ngac*** and password to ***NGACsystem123$*** or change this in the code file named ***db_conn.php***. 

To make the test page work, download our implementation or implement you'r own version of pep and rap. Then start the pep_server, to do this with our implementation first navigate to the ***PEP-RAP*** directory and enter the following commands 
```
swipl
```
,
```
[rap].
```
, 
```[pep].``` and 
```pep_server.```. You must also have actual documents in the PEP-RAP directory, for the objects to make this page work. 

### Usage
You must start the ngac server in json respones mode by writing ```./ngac-server -j``` in the command promt, if it is successfully started the ngac server will be shown as online. Now you can create you'r own policy using one of the crafting tools and the loading it to the ngac server. More information of you'r policies can be found when clicking on the policy name or you can edit the policy. You can edit, add or remove users and objects by clicking ***show admin overlay*** in the bottom of the admin page.

The test page is used to test the access between users and objects of the active policy. Simply select the user an the object to performe the test. 

# License
Distributed under the MIT License. See ***LICENSE*** for more information.

# Contributers
This project was made for educational purposes by Luleå Technical University. It was superviced by ***Ulf Bodin*** and ***Alex Chiquito***.
## Created by
- Jesper Frisk
- Birger Weis
- Emil Nyberg
- Ilaman Esenov
