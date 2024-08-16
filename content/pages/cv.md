# Chris Harrison

[chrisharrison.me.uk](https://chrisharrison.me.uk) / me@chrisharrison.me.uk / +44 (0)7871 562518

<section id="skills" markdown="1">

## Skills

* Accessibility
* API design
* AWS
* Azure
* Docker
* Domain driven design
* Elasticsearch
* ES6
* Event sourcing
* Git
* Graph databases
* GraphQL
* Helm
* Java
* JavaScript
* Kubernetes
* MVC frameworks
* Node.js
* Objective C
* PHP
* Python
* React
* React Native
* Redis
* Ruby
* SaaS
* SOLID OOP
* Swift
* Terraform
* TDD
* Typescript
* Unit testing

</section>

<section id="experience" markdown="1">

<div class="dont-break" markdown="1">
### Senior software engineer, EDF Energy

* {$CAL} January 2023 - Present
* {$MAP} Exeter, UK
</div>

<div class="dont-break" markdown="1">
### Software engineer, EDF Energy

* {$CAL} August 2021 - January 2023
* {$MAP} Exeter, UK
* Part of an engineering team in Wholesale Market Services supporting short term trading.
</div>

<div class="dont-break" markdown="1">
### Senior software engineer, Black Tree Gaming Ltd

* {$CAL} July 2020 - August 2021
* {$MAP} Exeter, UK
* Black Tree Gaming is the company behind [Nexus Mods](https://nexusmods.com). The website hosts 300k gaming mods. The user base is 26 million strong and there have been over 4.6 billion mod downloads to date.
* August 2020 I introduced a domain events system into the architecture to handle communication between the various microservices.
* Sep - Dec 2020 I architected a notifications microservice to completely replace the way user notifications are delivered on the site. The 70 legacy notifications were part of a monolithic app embedded throughout the business logic. I replaced the trigger points with a set of domain events and wrote a new service in Ruby to fan out those domain events to user notifications. The deployment configuration was written in Kube/Helm.
* Jan 2021 I replaced the way that mod searching worked throughout the site. The original mechanism used SQL to search a single table. I added a series of new domain events to reflect changes to mods into an Elasticsearch instance. All the queries were then converted to use Elasticsearch. Considering the original SQL queries had 30 different filtering, ordering and search options - there were many challenges.
* March 2021 I embarked on a project to reduce the ratio of reads/writes on a legacy MySQL cluster that serves 30,000 queries per second.
</div>

<div class="dont-break" markdown="1">
### Technical lead, Funeral Guide Ltd

* {$CAL} January 2019 - Present
* {$MAP} Exeter, UK
* Headed up development of the 'Arranger' SaaS product. Responsible for working with the product owner to manage sprints and to provide technical oversight and direction of both frontend and backend delivery. Was also a line manager to other engineers and acted as scrum master.
* Responsible for the technical delivery and architecture of 'Arranger'. The API is an event sourced suite of microservices written in Node.js and PHP. The architecture is fully tenanted. The frontend is written in React and utilises Redux state management, offline capability and GraphQL. Arranger manages a funeral business' backend processes and offers a personalised service to the bereaved via an easy to use, graphically rich tablet interface.
</div>

<div class="dont-break" markdown="1">
### Senior software engineer, Funeral Guide Ltd

* {$CAL} November 2016 - January 2019
* {$MAP} Exeter, UK
* Nov 2016 to May 2017 I took charge of writing the Memoria app. Written in React Native as a hybrid app, it was released to the Play Store and App Store.
* Jan 2017 I wrote an Identity Service, which was a periphery microservice for the Memoria backend. The service handled our own OAuth2 tokens and 3rd party social media credentials.
* April 2017 I wrote a Notifications Service, which was a periphery microservice for the Memoria backend. The service handled all types of user notification (including push notifications) emitted by events within the Memoria domain. The system worked as a set of cross-referencing Amazon SNS channels for each user.
* Sep 2017 I worked on a CI/CD system for automatically building microservices as Docker containers and pushing them to Amazon ECR. The build system enforced unit test coverage of 90% and code conformance to the PSR-12 standard.
* Nov 2017 I was part of the winning team in a company hackathon. Our idea was a 'virtual remembrance'. I helped implement the backend in Node.js using websockets.
* Dec 2017 I gave a talk about event sourcing at Tech Exeter: https://bit.ly/event-sourcing-dec-2017
</div>

<div class="dont-break" markdown="1">
### Software developer, Microtest Health

* {$CAL} April 2016 - November 2016
* {$MAP} Cornwall, UK
* Microtest is one of 4 'tier 1 providers' of software to the UK's National Health Service.
* Wrote web based clinical software for use in the NHS. Worked within an Agile team with a 1:1 dev/tester ratio.
* Worked to guidelines set by clinical safety officer.
* Worked on a fast vaccination service. Ability for clinic leaders to specify vaccinations, vaccination routes/jab sites and patients. Practitioner can quickly and easily record vaccinations into patient notes after vaccinations performed.
* Architected a locum matching service for GP practices to book locum doctors into sessions. System handled the locums' PDF based invoices and NHS pension forms based on hours worked.
</div>

<div class="dont-break" markdown="1">
### Technical lead, Xamble Group Ltd

* {$CAL} January 2014 - April 2016
* {$MAP} Singapore
* Took over responsibility of a mobile app called Dayre - a popular social media platform in the Asia Pacific region. Has 500k users and 100 req/sec and above regularly hitting the API. Service requirements were high traffic / high availability.
* Acted as line manager to a technical team of 7 made up of developers and designers.
* Responsible for working with product manager and CEO to plan new features, architect software and document existing systems.
* Responsible for hiring. Also, mentoring team, introducing best practices and reviewing new technologies.
* May to Nov 2014 I oversaw the migration of the backend (as well as the iOS and Android clients) from a service called parse.com to a PHP/SQL/Redis backend hosted on AWS. We increased the average response time from 2 secs to 50ms.
* I wrote a completely custom JSON parser to convert 100GB of parse.com JSON data into SQL. Because speed was important for minimal downtime, it was designed to work in parallel across multiple machines without introducing any inconsistencies in the data.
* Implemented the web frontend at dayre.me. The website acts as a frontend client, accessing the backend over our REST API.
* Jan to March 2015 I rewrote the Dayre iOS app from scratch in Swift.
* Mid 2015 spent time optimising image uploads and geo-locating the CDN's DNS to save costs.
* Nov 2015 I started the process of migrating from AWS to Azure as part of a partnership with Microsoft.
* Developed a "fan-out" NoSQL based user feed system using publish/subscribe pattern and Redis.
</div>

<div class="dont-break" markdown="1">
### Senior web developer, Induxive

* {$CAL} September 2012 - January 2014
* {$MAP} Johor, Malaysia
* Worked on a variety of medium sized client projects. Area of responsibility was frontend and backend development.
* Clients included:
* MGP. One of the top fashion ecommerce stores in Singapore. Prestashop implementation with 8 custom modules written for the project. (https://mgplabel.com)
* Other clients: Sheraton Hotels, Toytag, Viva Creation
</div>

<div class="dont-break" markdown="1">
### Web developer, Ripple Digital

* {$CAL} April 2010 - September 2012
* {$MAP} Singapore
* Developed imotiv.ly a blog aggregating platform. Part of the Nuffnang blog advertising network with over a million blogs and present in over ten countries in Asia and Europe. One of the design goals was that the web crawler would reflect any change in the 1 million strong index within a maximum of 5 minutes.
* Developed a patent-pending summary system to grab the most 'interesting' sentence from a blog post. Involved natural language processing (NLP).
* Led the development of propmatch.com a property portal for Singapore that was receiving 70,000 uniques per month at its peak.
* Worked on client projects such as microsites, Facebook applications and larger scale web applications.
* Clients included Peel Fresh, Pioneer, United Nations, Nissan, Love Bonito (Singapore's largest online fashion retailer), Jipaban, Nuffnang.
* Wide experience integrating with third party APIs. Payment gateways, REST etc.
* Developed over twenty modules for the open source eCommerce platform Prestashop.
</div>

<div class="dont-break" markdown="1">
### Web developer, Ren Media Ltd

* {$CAL} April 2009 - April 2010
* {$MAP} London, UK
* Built in-house classifieds websites for marketing UK companies to China.
* Extensive experience of localisation/i18n for Chinese users.
</div>

</section>

<section id="education" markdown="1">

## Education

Bachelor of Arts Upper Second Class, Middlesex University (2009)

</section>
