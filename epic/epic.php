<!DOCTYPE html>
<html lang=" 'en">
	<head>
		<meta charset="utf 8"/>
		<title>Crumbtrail </title>
		<link rel="stylesheet" href="css/stylesheet.css" type="text/css"/>
	</head>
	<body>
		<main>
			<div class
			<header>
				<h1 class="accent">crumbtrail: Connecting food trucks and hungry people.</h1>
			</header>

			<div class= mainheaders>
				<h2>Goals</h2>
			</div>
			<div class="textfields"
				<p><strong>Crumbtrail allows food trucks to share their location and allows hungry people to find
						food trucks that are serving now.</strong></p>

				<p>The core experience of the hungry eater will be streamlined, with very little navigation necessary.
					When the eater opens the app, they will immediately see their location on a map as wellas tickers
					for any trucks in the city.</p>

				<p>The core food truck experience will be also streamlined, with very little
				navigation necessary. When a truck is ready to serve, the trucker hits
				one button in the app, and hungry users will immediately know the active
				truck's location.</p>
			<br>

				<h3>Eater map page (using Google Maps API):</h3>
					<ol>
						<li>Shows the eater's location, at the center of the map.</li>
						<li>Shows the locations of nearby active food trucks.</li>
						<li>"Truck login/sign up" button, at top right corner.</li>
						<li>"Complete list" of trucks button, at top left corner.</li>
						<li>Search field, top center.</li>
						<li>List of nearby active food trucks, slides up from bottom.  Shows nearest trucks first.</li>
					</ol>

				<h3>Complete list of all companies page:</h3>
					<ol>
						<li>A list of all food truck companies that are registered on crumbtrail.</li>
						<li>Shows the name of the company, and a short description of the food they serve.</li>
						<li>By touching the name of a company on a list, the user can see the company's profile page.</li>
					</ol>

				<h3>Company description page:</h3>
					<ol>
						<li>Shows whether or not any of the company's trucks are "Live" (serving now).</li>
						<li>Business name.</li>
						<li>Photo of the truck(s).</li>
						<li>Blurb about who they are.</li>
						<li>General type of food served and/or menu.</li>
						<li>Weekly schedule of locations.</li>
						<li>Space for showing special event day and location.</li>
					</ol>

				<h3>User login/registration page:</h3>
				<ol>
					<li>User gets to this page by pressing the top right button on the eater map page</li>
					<li>Company name field, password field, login button.</li>
					<li>"New company registration" button, links to New Company Registration page.</li>
				</ol>

				<h3>Truck map page:</h3>
					<ol>
						<li>The user gets to this page via the user login/registration page.</li>
						<li>When the truck is ready to serve food, the user toggles a "Go Live" switch.</li>
						<li>In the "on" position, switch is green and the truck's location is visible on the maps.</li>
						<li>In the "off" position, switch is red and the truck's location is not visible on the maps.</li>
						<li>The truck's location is at the center of the truck map page.</li>
						<li>User also sees radio buttons, to choose which of the company's trucks they are serving from: "Truck #1", "Truck #2", etc.</li>
						<li>User can also set the "End time" for when the truck will close.</li>
					</ol>

				<h3>Edit company profile page:</h3>
				<ol>
					<li>Admin gets to this page via the company profile page.</li>
					<li>Business name.</li>
					<li>Photo of the truck (a way to choose a photo?)</li>
					<li>Blurb about who they are.</li>
					<li>General type of food served and/or menu.</li>
					<li>A text field for them to enter their schedule of times/days and locations.</li>
					<li>Space for showing special event day and location.</li>
				</ol>

				<h3>Edit user profile page:</h3>
				<ol>
					<li>User name</li>
					<li>User email.</li>
					<li>User password</li>
					<li>Permit number (admin only)</li>
					<li>License number (admin only)</li>
				</ol>

				<h3>Company settings page (admins only):</h3>
				<ol>
					<li>Change number of trucks</li>
					<li>Invite employees to become users, associated with that company</li>
					<li>Change company email, etc.</li>
				</ol>

				<h3>New user registration page:</h3>
				<ol>
					<li>Name of user</li>
					<li>Email of user</li>
					<li>Business permit number (for admin)</li>
					<li>Health inspection number (for admin)</li>
				</ol>

			<h3>New company profile creation page:</h3>
			<ol>
				<li>Name of company</li>
				<li>Company email</li>
				<li>Company phone number</li>
				<li>Menu</li>
				<li>Weekly schedule, as a simple text box.</li>
			</ol>
			<br>

			<hr>
			<h2>Persona for Company Admin</h2>
			<p>NAME: Gloria McTruckerson</p>
			<p>AGE: 32</p>
			<p>PROFESSION:Food truck business co-owner</p>
			<p>TECHNOLOGY: A three year old laptop with a Windows 10 operating system. An iPhone 6s with a 4G Data Connection</p>
			<p><strong>Attitudes & Behaviors:</strong>Gloria is a co-owner of the FoodParty food truck business with her sister, Truckina. Both Gloria and her sister work about 60 hours/ week running the business. They have two trucks, one full time employee, and four part time employees. Gloria works in all aspects of the business. She orders supplies from distributors, she does the cooking, she does administrative/hiring work, she sends out payroll, and takes care of the webpage. She has a lot to do, but she is always looking for ways to improve the business.</p>
			<p><strong>Frustrations & Needs:</strong>She wants to be able to broadcast her location to customers on multiple platforms. She needs an application that she doesn’t need to focus too much time on, but that allows her to show her location to crumbtrail users, and also allows her to cross post on her other social media platforms including mainly facebook, instagram, and twitter.
			</p>
			<p>Gloria has two trucks that go to multiple locations at once. She needs to be able to say that her business, FoodParty, is at both of those locations.
			</p>
			<p>Gloria has a lot to take care of and sometimes she can be forgetful, so it is important that this application allows her to put an end time for when she anticipates to stop serving in that location. This would be helpful because she does not want to disappoint her customers by forgetting to remove her location and leaving, and having customers come by looking for her. Of course, food trucking is very flexible and sometimes Gloria stays in one place longer than she had anticipated. Because of this, it would be helpful for her if at the end of the original time she entered (e.g. 3 pm) she was sent a notification to say “Your location has been turned off. Are you still serving? Until what time?”. If she is still serving she can say “Yes!” and her location will be turned on, and she can modify the time that she will be serving until. If she is not serving anymore she can say “no” or just ignore the message and her location will remain turned off.</p>
			<p>Gloria gets one day off per week: Sundays: On Sundays, Truckina takes care of all business operations. So she needs full access to this app too in order to add employee collaborators, change business info, update the menu/schedule, etc. She also has employees who sometimes take the truck out on their own when she is busy with catering events. She needs those employees to be able to have access to sharing the truck’s location with CrumbTrail/Social Media from their personal phones.
			</p>
			<p>Lastly, Gloria finds that her customers want to know where she will be in the future so they can plan their days/meals around it. She wants to be able to share her weekly schedule. Her schedule typically stays the same but can change from time to time so she wants to ability to edit it for the current week. She also does special events that she would like to share the dates and locations of. They are separate from her normal weekly routine, and many times require tickets to get into the event (e.g. event at balloon fiesta park) so she wants her customers to be able to see where they will be and get tickets if they want to.
			</p>
			<p><strong>Goals:</strong>Gloria’s main goal is to find a way to easily broadcast the location of her food truck, which is always changing. She wants to be able to share that information with her loyal customers, as well as with new customers who have not tried or may have never heard of FoodParty. She is looking for an easy to use application that she can trust to allow her, her co-owner Truckina, and her employees to use in real time.</p>
			<p>Her second goal of Gloria’s is to have a platform to share FoodParty’s projected schedule for the week, which typically doesn’t change too much, as well as share the dates and times for special events.</p>
			<h2>Use Case</h2>
			<p><strong>What:</strong>iPhone6 with 4G Data Connection</p>
			<p><strong>Who:</strong>Co-owner of a food truck business</p>
			<p><strong>Why:</strong>She wants an easy to use program that will allow her and her employees to broadcast their location in real time while they are serving, to describe what their business is and serves, and a place to set a projected schedule for their customers (and new customers) to see. </p>
			<h2>User Story</h2>
			<ol>
				<li>As a food truck owner, I have driven to the location where I am serving food and would like to quickly share my location and estimated end time over the CrumbTrail app so I can get to food prepping.</li>
				<li>As a food truck owner, I am trying to sign up my FoodParty truck for CrumbTrail.</li>
				<li>As a food truck owner and supervisor, I am doing administrative work in the office while my employee is out with the truck. This employee just dropped her smartphone in the toilet, so I need to be able to share her location while sitting in my office. I know that she is going to Hyder Park, and I found the address online.
				</li>
			</ol>
			<h2>Interaction Flow</h2>
			<h4>Goal: As a food truck owner, I want to set up an account with CrumbTrail</h4>
			<ol>
				<li>open app, or type in url</li>
				<li>opens up to user homepage. Click on “Sign In” in the top right corner</li>
				<li>Click on "register new company" underneath the fields for sign in.</li>
				<li>Takes food truck owner to the registration page. They have to input all of their info for the company, including their business license.</li>
				<li>click "register"</li>
				<li>take to confirmation page that tells them their login information has been sent to a CrumbTrail admin to be confirmed, and to check their email in the next 48 hours</li>
			</ol>
			<h4>Goal: As a food truck owner, I have arrived at the location I am going to serve at and would like to share my location on CrumbTrail</h4>
			<ol>
				<li>open app, or type in url</li>
				<li>Opens to user home map page. Push "Sign In" in the top right corner</li>
				<li>at sign in page, food truck owner enters their personal email address and password that they registered with, and push "log in"</li>
				<li>food truck owner is now at the food truck home page, which is a map with their current location pinged, and the pinged locations of other active food trucks in the area. Click the button "Serving Now"</li>
				<li>The food truck owner is prompted to enter location (can enter one or use current location), end time, and which truck is out. User enters this information and clicks “ok”.
				</li>
				<li>When employee is done, user clicks “stop serving” button, or it is automatically shut off after the input end time
				</li>
			</ol>
			<h4>Goal: As a food truck owner, I am at the office and need to put out the location for my employee who has the truck, but dropped her phone in the toilet</h4>
			<ol>
				<li>open app, or type in url</li>
				<li>Opens to user's home map page. Push  "Sign In" in the top right corner</li>
				<li>At Sign In page, user enters their personal email address and password that they registered with, and push “Log In”</li>
				<li>User is now at the food truck home page, which is a map with their current location pinged, and the pinged locations of other active food trucks in the area. Click the button “Serving Now”
				</li>
				<li>The user is prompted to enter location of employee, time, and which truck is out. User enters this information and clicks “ok”.
				</li>
				<li>When the employee is done, user clicks “stop serving” button, or it is automatically shut off after the input end time.  </li>
			</ol>

			<hr>
			<h2>Persona for company employee</h2>
			<p>NAME: Freddy foodtuck</p>
			<p>AGE:22</p>
			<p>PROFESSION: Student and working part time as a food truck driver & cashier</p>
			<p>TECHNOLOGY: Using a Andriod smartphone</p>
			<p>ATTITUDES & BEHAVIORS: Freddy is going to school and working part time as a food truck minion. Time is always of the essence, so he can't be wasting any trying to sign into an application and broadcast his location.</p>
			<p>FRUSTRATIONS & NEEDS: Freddy needs to waste as little time as possible logging into the application, and broadcasting his signal. Additionally, he has no interest in spending anything more than a couple minutes registering his account with the application. He needs to login, broadcast location, and start cooking food and helping customers</p>
			<p>GOALS: Freddy's goal is to have the process of using an application to broadcast his location take less than 20 seconds, so his boss knows he's working and where he is, and most importantly the customers know where he is.</p>
			<h2>User Story</h2>
			<p> Freddy is going to school full time and working part time for a food truck company. He has very little time to set up the truck, prepare food, drive to the location and start serving customers. He needs a quick and efficient method of creating a profile in the application used by his boss which will allow him to login and broadcast his location.</p>
			<h2>Use Case</h2>
			<ul>
				<li><strong>Who:</strong> Freddy Foodtruck</li>
				<li><strong>What:</strong> Employee for a food truck company</li>
				<li><strong>When:</strong> All times of day, and various days of the week</li>
				<li><strong>Why:</strong> Because he needs to make money</li>
				<li><strong>Where:</strong> In a truck on his andriod smartphone</li>
			</ul>
			<h2>Interaction Flow</h2>
			<h4>Signing up for application</h4>
			<ol>
				<li>Admin/owner of company account will enter the email of the person they wish to grant a employee account.</li>
				<li>This will generate an email which is sent to the employee.</li>
				<li>Once the potential employee clicks on the email, they are redirected to a unique signup page where their email is already pre-loaded.</li>
				<li>They then fill in their name, and password x2, and a phone number to create a employee account.</li>
				<li>Once they submit all this information, they will receive an email asking them to verify their account creation.</li>
				<li>After clicking on the link, their account has been created</li>
			</ol>

			<h4>Using the application</h4>
			<ol>
				<li>Employee clicks on the CrumbTrail application icon on their phone</li>
				<li>On the application home screen, they click on the login button, which opens a new page</li>
				<li>On that page they enter their email and password to login</li>
				<li>After logging in, they are directed to the 'truck-map' page, where they see their location in google maps, and have the option to broadcast their location</li>
				<li>After clicking "broadcast now" the employee will be prompted to confirm the sharing of their location. After doing so, the map display changes to show a green "serving now" banner accross the top for as long as they wish to broadcast their location </li>
				<li>Once the employee has finished serving, they click the "serving now" banner to cancel the transmission of their location.</li>
			</ol>
			<hr>

			<h2>Persona, for someone who plans to eat at a food truck in the future</h2>
			<p>Name: Will B. Hungry</p>
			<p>Age: 29</p>
			<p>Profession: Will is a history instructor at CNM.</p>
			<p>Technology: Will always carries his Android smart phone in his pocket.  At home, he uses a Dell laptop running Linux.  His network connection at home is just fast enough for streaming movies, but is not extremely speedy.</p>
			<p>Attitudes and behaviors: Will does not like to cook.  He loves eating at resturants and food trucks, both for the food and for the social atmosphere.  In the past, Will has really enjoyed eating from food trucks at music festivals, but he has not used a food truck in Albuquerque.</p>
			<p>Frustrations and needs: Not only does Will hate to cook, but his apartment has a tiny kitchen which is too cramped to prepare anything except coffee.  Will has a few favorite resturants in Albuquerque, but he wants to try new resturants and he is hoping to find some good food trucks in town.  To find food trucks, he could simply Google "food trucks Albuquerque", but then he would have to wade through each food truck's website, looking for the type of food they serve, and trying to find their schedule of days, times and locations.</p>
			<p>Goals: Will is going out with friends this Saturday night.  They plan to meet in the downtown area around 8 pm, and look for a late dinner.  Will suspects they can find food trucks downtown on a Saturday night, and he would like to learn where the food trucks will be located that night.  On Saturday afternoon, Will wants to use his laptop to find which trucks will be located in downtown Albuquerque that night, where exactly they will be parked, and what kind of food they will be serving.</p>

			<h2>Interaction flow</h2>
				<ol>
					<li>User opens the web browser on their laptop, and finds the crumbtrails website.</li>
					<li>User sees the Map page, which shows the current locations of food trucks that are now serving food in Albuquerque.</li>
					<li>User clicks the "Show complete list" button.</li>
					<li>User sees a list of all the food trucks that are registered with crumbtrails.  For each truck, the list shows the truck name and a very short description of the type of food that the truck serves.</li>
					<li>User scrolls through the list, looking for an interesting truck.</li>
					<li>User clicks on the truck name, and is taken to that truck's profile page, which shows the truck name, the truck blurb, and the truck's schedule (and a photo of the truck?).</li>
					<li>User clicks on the "Back to list" button, to look for more interesting trucks.</li>
					<li>User chooses the truck they want to visit in the future, and bookmarks the truck profile page.</li>
				</ol>
			<hr>
			<h2>Persona for the user who wants to eat now.</h2>
			<p>Name: Florence Gray</p>
			<p>Age: 20</p>
			<p>Profession: Florence is a part time coffee shop worker in the downtown area. She works in-between classes and is always busy.</p>
			<p>Technology: Florence is an Android phone user. However, she does have a Macbook Pro that she uses while in class. She is fluent with both platforms.</p>
			<p>Attitudes and behaviors: Florence is a very busy worker and student. She does not like waiting in long lines for food. She is intrigued by new things, especially new types of food. Sometimes though, when she wants something specific she is set on that idea. She spends a lot of her time on her phone, so if she is going to search for anything it will be through mobile web or apps.</p>
			<p>Frustrations and Needs: Florence is busy, she doesn't have time to just walk around a hope she finds something to eat. She wants it now, she wants to know where she is going. From the time she leaves class, she has about three to five minutes to decided where she is going to go. If she is leaving from work, she is more flexible, but doesn't want to spend a lot of time searching for something to eat, she is already exhausted from a long day.  </p>
			<p>Goals: Florence just got out of class. She has one hour till her next class. She wants to go eat with some friends today. Tacos are the food choice they decide. Florence wants to hop onto CrumbTrail and track down the closest Taco truck so they can eat and get back to campus. </p>
			<h2>Interaction Flow</h2>
			<ol>
				<li>Florence will look up www.crumbtrail.io</li>
				<li>She will use the search bar and type in "tacos"</li>
				<li>The map will post all food truck that are open in that area</li>
			</ol>
			<hr>
			<h2>Conceptual model: Database entities:</h2>
			<ul>
				<li>profile</li>
				<li>company</li>
				<li>image</li>
				<li>truck</li>
				<li>event</li>
			</ul>
			<h2>Conceptual model: Database relationships:</h2>
				<ul>
					<li>Each profile can work for many companies.</li>
					<li>Each company can have many profiles.</li>
					<li>So the relationship between profile and company is many-to-many.</li>
					<li>So there will be a weak entity between profile and company.</li>
					<li>Each company can have many trucks.</li>
					<li>Each truck is owned by one company.</li>
					<li>So the relationship between company and truck is one-to-many.</li>
					<li>Each company can have many images.</li>
					<li>Many images can belong to one company.</li>
					<li>So the relationship between company and image is one-to-many.</li>
					<li>Each event belongs to one truck.</li>
					<li>Each truck has many events. (The current event and past events).</li>
					<li>So the relationship between truck and event is one-to-many.</li>
				</ul>
				<br>
			<hr>
			<h2>ERD, diagram of database structure:</h2>
				<img src="images/crumbtrail ERD2.svg" alt="ERD" width="800px"/>
			<br>
		</main>
	</body>
</html>