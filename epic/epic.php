<!DOCTYPE html>
<html lang=" 'en">
	<head>
		<meta charset="utf 8"/>
		<title>Crumbtrail </title>
		<!-- <link rel="stylesheet" href="css/stylesheet.css" type="text/css"/> -->
	</head>
	<body>
		<main>
			<div class
			<header>
				<h1>crumbtrail: Connecting food trucks and hungry people.</h1>
			</header>

			<div class= mainheaders>
				<h2>Goals</h2>
			</div>
			<div class="textfields"
				<p><strong>Crumbtrail allows food trucks to share their location and allows users to find
						food trucks that are serving now</strong></p>
			<br>

			<p><strong>For the hungry user: </strong></p>
			<ul>
				<li>The core user experience will be streamlined, with very little navigation necessary.
					When the user opens the app, they will immediately see their location on a map as well
					as tickers for any trucks in the city</li>
				<br>

				<li>User's map view (Google Maps API):</li>
					<ol>
						<li>Shows the user's location, at the center of the map.</li>
						<li>Shows the locations of nearby active food trucks.</li>
						<li>"Truck login/sign up" button, at top right corner.</li>
						<li>"Complete list" of trucks button, at top left corner.</li>
						<li>Search field, top center.</li>
						<li>List of nearby active food trucks, slides up from bottom.  Shows nearest trucks first.</li>
					</ol>
				<br>

				<li>Complete list view:</li>
					<ol>
						<li>A list of all food trucks that are registered on crumbtrail.</li>
						<li>Shows the name of the truck, and a short description of the food they serve.</li>
						<li>By touching the name of a truck on a list, the user can see the truck's profile page.</li>
					</ol>
			<br>

				<li>Food truck profile view:</li>
					<ol>
						<li>If the truck is serving, the user sees a green "Go to map" button, which shows the live food truck's location at the center of the map.</li>
						<li>Business name.</li>
						<li>Photo of the truck.</li>
						<li>Blurb about who they are.</li>
						<li>General type of food served and/or menu.</li>
						<li>Links to social media (?).</li>
						<li>Weekly schedule of locations.</li>
						<li>Space for showing special event day and location.</li>
					</ol>
			</ul>
			<br>

			<p><strong>For the food truck owner or employee:</strong></p>
			<ul>
				<li>The core food truck experience will be also streamlined, with very little
					navigation necessary. When a truck is ready to serve, the trucker hits
					one button in the app, and hungry users will immediately know the active
					truck's location. </li>
				<br>

				<li>The map view for food truckers:</li>
					<ol>
						<li>When the truck is ready to serve food, the worker toggles a "Go Live" switch.</li>
						<li>In the "on" position, switch is green and the truck's location is visible on the maps.</li>
						<li>In the "off" position, switch is red and the truck's location is not visible on the maps.</li>
						<li>The truck's location is at the center of the trucker's map.</li>
						<li>The worker can look at the "Go Live" switch to confirm that their truck is now shown on the map.</li>
						<li>A button which links to the truck profile editing page.</li>
						<li>A button which links to the truck settings page.</li>
					</ol>
				<br>

				<li>Trucker's login/registration page:</li>
					<ol>
						<li>Truck name field, password field, login button.  Successful login takes the trucker to the trucker's map view.</li>
						<li>"New truck registration" button, links to New Truck Registration page.</li>
					</ol>
				<br>

				<li>New truck registration page, with form boxes to fill in:</li>
					<ol>
						<li>Admin's first name, last name, email, phone number.</li>
						<li>Company name.</li>
						<li>Company address.</li>
						<li>Business license number.</li>
						<li>Health inspection number?</li>
					</ol>
				<br>

				<li>Truck profile editing page, with editable field for:</li>
				<ol>
					<li>Business name.</li>
					<li>Photo of the truck (a way to choose a photo?)</li>
					<li>Blurb about who they are.</li>
					<li>General type of food served and/or menu.</li>
					<li>Links to social media (?).</li>
					<li>Weekly schedule of locations.</li>
					<li>Space for showing special event day and location.</li>
				</ol>
				<br>

				<li>Truck's settings page:</li>
				<ol>
					<li>A way to invite other admins or employees to login to their company.</li>
					<li>more?</li>
					<li>more?</li>
				</ol>
			</ul>
			<br>

			<hr>
			<h2>Persona for Company Admin</h2>
			<p>NAME: Gloria McTruckerson</p>
			<p>AGE: 32</p>
			<p>PROFESSION:Food truck business co-owner</p>
			<p>TECHNOLOGY: A three year old laptop with a Windows 10 operating system. An iPhone 6s with a 4G Data Connection</p>
			<p><strong>Attitudes & Behaviors</strong>Gloria is a co-owner of the FoodParty food truck business with her sister, Truckina. Both Gloria and her sister work about 60 hours/ week running the business. They have two trucks, one full time employee, and four part time employees. Gloria works in all aspects of the business. She orders supplies from distributors, she does the cooking, she does administrative/hiring work, she sends out payroll, and takes care of the webpage. She has a lot to do, but she is always looking for ways to improve the business.</p>

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

			<h2>Persona, for someone who plans to eat at a food truck in the future.</h2>
			<p>Name: Will B. Hungry</p>
			<p>Age: 29</p>
			<p>Profession: Will is a history instructor at CNM.</p>
			<p>Technology: Will always carries his Android smart phone in his pocket.  At home, he uses a Dell laptop running Linux.  His network connection at home is just fast enough for streaming movies, but is not extremely speedy.</p>
			<p>Attitudes and behaviors: Will does not like to cook.  He loves eating at resturants and food trucks, both for the food and for the social atmosphere.  In the past, Will has really enjoyed eating from food trucks at music festivals, but he has not used a food truck in Albuquerque.</p>
			<p>Frustrations and needs: Not only does Will hate to cook, but his apartment has a tiny kitchen which is too cramped to prepare anything except coffee.  Will has a few favorite resturants in Albuquerque, but he wants to try new resturants and he is hoping to find some good food trucks in town.  To find food trucks, he could simply Google "food trucks Albuquerque", but then he would have to wade through each food truck's website, looking for the type of food they serve, and trying to find their schedule of days, times and locations.</p>
			<p>Goals: Will is going out with friends this Saturday night.  They plan to meet in the downtown area around 8 pm, and look for a late dinner.  Will suspects they can find food trucks downtown on a Saturday night, and he would like to learn where the food trucks will be located that night.  On Saturday afternoon, Will wants to use his laptop to find which trucks will be located in downtown Albuquerque that night, where exactly they will be parked, and what kind of food they will be serving.</p>

			<h2>Interaction flow, for someone who plans to eat at a food truck in the future.</h2>
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
			<h2>Conceptual model, of database structure:</h2>
				<ul>
					<li>Each user (owner [admin] or employee) can belong to many companies.</li>
					<li>Each company can have more than one user.</li>
					<li>The relationship between user and company is many-to-many.</li>
					<li>Each company can have many trucks.</li>
					<li>Each truck belongs to only one company.</li>
					<li>The relationship between company and truck is one-to-many.</li>
					<li>Each truck has many schedule items (location/time combinations).</li>
					<li>Each schedule belongs to only one truck.</li>
					<li>The relationship between schedule and truck is one-to-many.</li>
					<li>The worker entity specifies the relationship between user and company.  Each worker has a workerType: "A" for admin, or "E" for employee. </li>
				</ul>
			<hr>
			<h2>ERD, diagram of database structure:</h2>
				<img src="images/crumbtrail ERD.svg" alt="ERD" width="900px"/>
			<br>
		</main>
	</body>
</html>