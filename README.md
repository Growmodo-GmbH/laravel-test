<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
    </a>
</p>

# <p align="center">Laravel Test</p>
<p align="center">
    A <a href="https://www.growmodo.com" target="_blank">Growmodo</a>'s trial task for laravel developers.
</p>

<p align="center">
    Join a fast-growing team of rockstar creatives and code wizards who are passionate about making customers say “WOW”. If you believe you have what it takes and want to grow your career instead of just finding another job - you are at the right place!
</p>

<p align="center">
    <a href="https://www.growmodo.com/application" target="_blank">
        <img src="https://img.shields.io/badge/Apply Now-blue" alt="Apply Now"/>
    </a>
</p>

## Instructions
 - Fork the `main` branch of this repository.
 - Clone the repository you forked on your local machine, <a href="#setup">and setup to work on the branch assigned to you</a>.
 - Update `.env` according to your needs, <code style="color : red">except</code> for the database credentials starting with `DB_*`.
 - Work on the task assigned to you.
 - When you are ready, make a <a href="#push-and-pull-request-pr">Pull Request</a> to the `same branch` you are working on.

## Setup
 - Getting the specific branch assigned to you. Example branch: `john-laravel-test`
 - NOTE: Replace `john-laravel-test` with the branch name assigned to you
 
 - First, add this repo as new remote
 ```bash
 git remote add growmodo https://github.com/Growmodo-GmbH/laravel-test
 ```
 - Pull the branch from the remote repository
 ```bash
 git pull growmodo john-laravel-test
 ```
 - Make a local checkout of your branch
 ```bash
 git checkout -b john-laravel-test growmodo/john-laravel-test
 ```
 - Then start working on the task assigned to you.

## Push and Pull Request (`PR`)
 - Push changes to the specific branch assigned to you. Example branch: `john-laravel-test`
 - NOTE: Replace `john-laravel-test` with the branch name assigned to you
 ```bash
 git push origin john-laravel-test
 ```
 - Then make a pull request from the branch you are working to the same branch on growmodo repository

## Notes
 - Don not add `.env` to `.gitignore`.
 - Don't update database credentials, all keys starting with `DB_*`.
 - Branches that starts with `deploy-` are auto generated, do not make changes on this branches.
 - _***Important***_: Make sure to work and submit Pull Request (`PR`) only on the branch that is assigned to you.

## View Deployment
- When no errors encounter you should be able to see your app at: [https://test.growmodo.dev/\<BRANCH-NAME\>/public/](https://test.growmodo.dev/BRANCH-NAME/public/)
- Replace `<BRANCH-NAME>` with the name of the branch you are working to view the deployed app.

## About Laravel
Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling.

## Learning Laravel
Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

#

&copy; [Growmodo, GmbH](https://growmodo.com)
