# assignment-2-team-13
assignment-2-team-13 created by GitHub Classroom

This is assignment-2-by-Team-13

Team memmbers: Zaw Min Naing, Hoang Minh Dam, Xinhang Xu, Huy Long Nguyen.


## Environments
The Client-Doctor website is worked on in three environments

The production site: The live version of the site, containing the latest stable version of the theme and published site content
The staging site: The environment used to test the theme on a remote web server and draft web content
Local development environments: The virtual machine on your local device used to develop and test theme changes


## Branches
Main Branches
The project has two main branches:

master: The branch used by the production site
Staging: The branch used by the staging site (Your local development environment should be on this branch)
Feature Branches
When developing new features for the theme, do not work directly on the 'Staging' branch. Make an appropriately named feature branch off of 'Staging'. When the feature is finished, it should be merged back into 'Staging'.

As an example, if you wanted to develop the themes header, you would:

Make a new branch from 'Staging' called 'header'
Make changes to the themes header and test them within the 'header' branch
Merge the 'header' branch back into the 'Staging' branch when the header is complete

## Setting up your local environment

1. Open your command terminal and follow the instructions to create a Scotch Box virtual machine
2. Download Wordpress and extract the contents into the public folder of your Scotch Box
3. Delete the wp-content folder in wordpress
4. In the command terminal, navigate to the public folder of the Scotch Box and enter git clone https://github.com/JCUS-CMS/assignment-2-team-13 -b Staging to clone the website files
5. Rename the folder containing the project files to wp-content
6. Open your Scotch box in your web browser and follow the Wordpress installation process
7. When prompted to enter the database details, change the table prefix option to wpae_
8. Open the project files in your IDE of choice and [add any local project files to .gitignore] (https://git-scm.com/docs/gitignore)
9. Add the theme unit test to your local wordpress site

## Working on Site Content
To make it as easy as possible to migrate site content as well as to avoid having to move content from several different local environments, site content is to be drafted on the staging site. This provides an environment that is as close as possible to the live site that can be used to test content that can be accessed by anyone who is working on the site.

If you want to test how content will be affected by changes to the theme that are being tested in your local environment, migrate the database to your local environment.

## Update the remote site
### Webhooks
This project utilises webhooks to keep the staging an production sites up to date. Webhooks send data about activity on the Github repository to connected web pages. Both the staging and production site have webhooks that will respond to the following :

Staging site: a commit is pushed to the 'Staging' branch
Production site: a commit is pushed to the 'master' branch
When these activities occur, the site will automatically pull the latest version of the project files.





