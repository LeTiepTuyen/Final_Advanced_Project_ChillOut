### Project Plan: E-commerce Website - Chill Out Team


#### Overview


**Team Name:** Chill Out  
**Members:** Tiep Tuyen, Trung Tuyen, Hong Ngoc, Thieu Tin  
**Project Duration:** November 25 to January 8 (4 weeks)  
**Methodology:** Parallel work and Agile Scrum 
**Project Repository:** [GitHub Repository](https://github.com/LeTiepTuyen/Final_Advanced_Project_ChillOut.git)


## Sprints and Tasks


### Sprint 1: Ideation and Project Structure Design (November 23 - November 25)


**Wireframe on Figma:** [Wireframe](https://www.figma.com/design/U2kOgzZySkc1qvSHGO1xtZ/Wireframe_Ecommerce_Shopping?node-id=0-1&t=UBorofBEPqalx0oI-0)


| Task                                                                                                        | Assigned To      | Details                                                                   | Deadline | Status   |
| ----------------------------------------------------------------------------------------------------------- | ---------------- | ------------------------------------------------------------------------- | -------- | -------- |
| Determine the direction to convert the project to using Laravel to manage the backend and Nuxt 3 to manage the frontend. | All Team Members | Collaboratively brainstorm steps and design new project structure. | Nov 25  | Finished |


### Sprint 2: Project Initialization (November 26 - November 28)


| Task          | Assigned To | Details                                                                                                                                         | Deadline | Status   |
| ------------- | ----------- | ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | -------- |
| Setup Project | Tiep Tuyen  | Create and organize project structure. Create GitHub repository. | Nov 26   | Finished |
| Install dependencies and delete unnecessary tools | Hong Ngoc, Thieu Tin  | Delete Supabase, Prisma and install Axios, Laravel | Nov 26   | Finished |
| Convert database from Supabase to Laravel and PostgreSQL | Tiep Tuyen, Trung Tuyen  | Use Eloquent ORM, Laravel Migration and Seeders to create and control database on PostgreSQL. | Nov 28   | Finished |


### Sprint 3: Complete frontend using api from backend, install project activity tracking libraries, perform testing for backend and frontend. (November 29 - December 29)

#### Frontend
| Task                               | Assigned To | Details                                     | Deadline | Status   |
| ---------------------------------- | ----------- | ------------------------------------------- | -------- | -------- |
| Show homepage | Hong Ngoc  | Display product to homepage by fetching data from backend. | Dec 1  | Finished |
| Show detail product page | Thieu Tin | Show product detail page when clicking product from homepage | Dec 1 | Finished
| Refactor search bar and create Filter | Hong Ngoc | Use Laravel to do search function and make sort button products by price | Dec 5 | Finished
|Refactor Register and Login | Hong Ngoc, Thieu Tin | Use Laravel Sanctum to make register and login function | Dec 10| Finished
|Show ShoppingCart | Thieu Tin | Handle add to cart button and display products in shopping cart| Dec 3| Finished
|Lazy Loading | Thieu Tin | Use lazy loading to handle slow product display situation | Dec 10| Finished

#### Backend
| Task                               | Assigned To | Details                                     | Deadline | Status   |
| ---------------------------------- | ----------- | ------------------------------------------- | -------- | -------- |
| Error handling | Tiep Tuyen, Trung Tuyen | Setup error handling for backend by using Telescope, Slack Web Hook, Scramble, Pulse, Sentry, Error Page. | Dec 20 | Finished |
| Test backend | Trung Tuyen | Create Unit Test, Feature Test, Migrations Test | Dec 22| Finished |
| Test frontend | Trung Tuyen | Test UI/UX flows by Laravel Dusk | Dec 29 | Finished |

### Sprint 4: Optimize project scale and functionality (December 30 - January 5)


| Task                         | Assigned To | Details                                  | Deadline | Status   |
| ---------------------------- | ----------- | ---------------------------------------- | -------- | -------- |
| Add more data and test efficiency| All members   | Seed product to amount 1000, 5000, 10000 .          | December 31  | Finished |
| Improve the development environment | Tiep Tuyen   | Use Laravel Sail and Docker to control backend  | January 5  | Finished |



### Sprint 5: Final Test, complete final report (January 6 - January 7)


| Task                                                | Assigned To      | Details                                                                      | Deadline | Status  |
| --------------------------------------------------- | ---------------- | ---------------------------------------------------------------------------- | -------- | ------- |
| Test Web Performance, Functionality, and Fix Issues | All Team Members | Test the website's performance and functionality. Fix any identified issues. | Jan 6  | Finished |
|Complete Report | All Team Members | Describe project include database, workflow, project flow, tasks, tools | Jan 7  | Finished |

## Project Management


- **Task Assignment and Tracking:** Tasks will be managed on GitHub by creating issues for each task. Members will create pull requests upon task completion, which will be reviewed by the team leader before merging.
- **Communication:** Regular team meetings will be held to ensure smooth progress and address any blockers.


### Notes


- The project is divided into 5 sprints.
- Tasks are assigned to specific team members with defined deadlines to ensure timely completion.
- The project will be thoroughly tested, and any issues will be resolved before the final deployment.