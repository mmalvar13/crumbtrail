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
				<h1>Crumbtrail: Documentation</h1>
			</header>

			<div class= mainheaders>
				<h2>Crumbtrail Goals</h2>
			</div>
			<div class="textfields"
				<p><strong>Crumbtrail allows food trucks to share their location and allows users to find
						food trucks that are serving now</strong></p>
			<br>
			<p><strong>What do we want it to do?  User Side: </strong></p>
			<ul>
				<li>The core user experience will be streamlined, with very little navigation necessary.
					When the user opens the app, they will immediately see their location on a map as well
					as tickers for any trucks in the city</li>
				<br>

				<li>User's map view (Google Maps API):</li>
					<ol>
						<li>Shows the user's location, at the center of the map.</li>
						<li>Shows the locations of nearby active food trucks.</li>
					</ol>
				<br>

				<li>User's list view (slides up from bottom of map view):</li>
					<ol>
						<li>A list of all the food trucks now serving anywhere in ABQ.</li>
						<li>A list of food trucks now serving in a specific area of town.</li>
						<li>The user can search for trucks now serving a specific type of food.</li>
						<li>The user can search for a specific food truck.</li>
						<li>By touching the name of a truck on a list, the user can see the truck's profile page.</li>
					</ol>
			<br>

			<li>Food truck profile (one page for each truck):</li>
			<ol>
				<li>(See below)</li>
			</ol>
			</ul>
			<br>

			<p><strong>What do we want it to do?  Truck Side: </strong></p>
			<ul>
				<li>The core food truck experience will be also streamlined, with very little
					navigation necessary. When a truck is ready to serve, the trucker hits
					one button in the app, and hungry users will immediately know the active
					truck's location.</li>
				<br>

				<li>
					<ol>
						<li>We want food truck owners to create a profile to inform users about their truck.</li>
						<li>We want them to inform the community of their current location</li>
						<li>We want an avenue for food trucks to gain more business from the surrounding community</li>
						<li>We want food truck owners to be able to post future locations</li>
					</ol>
				</li>
				<br>

				<div>
				<li>Food truck's "I'm serving here now" view:</li>
					<ol>
						<li>The trucker presses one button, which logs the truck in and activates the
							truck's position on the users' maps.</li>
						<li>A second button allows the trucker to see and edit the truck's profile.</li>
					</ol>
				</div>
					<br>

				<li>Food truck's profile view, visible to users:</li>
				<ol>
					<li>Business Name</li>
					<li>Ability to login via facebook, and share posts across multiple platforms at once
						(facebook, instagram, twitter)</li>
					<li>Photo of the truck</li>
					<li>Blurb about who they are</li>
					<li>General type of food served and/or menu</li>
					<li>Links to social media</li>
					<li>Projected locations for the week/month</li>
					<li>Review and star ratings (imported from somewhere?)</li>
				</ol>
			</ul>


			<ul>
				<li><strong>Food trucks want to be able to quickly and easily advertise their location
						when they are currently serving</strong></li>
				<br>
				<li>***when they open the app, they can see a map of the city and the food trucks that are out now.</li>
				<li>They can easily push a button that says "serving now". Will provide a pop up that will
					detect their location and autofill for them by default. They also have the option of writing
					in a different location (in the case that an administrator/boss is in charge of the profile
					and sharing where one of their employees is with the truck) </li>
			</ul>

			<p>Each truck/business has a profile that is visible to users:</p>
			<ol>
				<li>on the server side, the profile may have:</li>
			</ol>
			<ul>
				<li>Email login/login with facebook option</li>
				<li>Password</li>
				<li>Name of business</li>
				<li>Image</li>
				<li>Social media links</li>
				<li>Automatic broadcast to social media?</li>
			</ul>

			<h2>Dreamthings:</h2>
			<ul>
				<li>automatic broadcast to social media</li>
				<li>social media login via facebook</li>
				<li>comment and rating system</li>
				<li>future locations of food trucks represented by pings on map</li>
			</ul>

			<h2>Executive Summary</h2>
			<br>
			</div>
			<div class= overview>
			<p>The purpose of this site is to allow users to find food trucks both on the go and as part of future planning. The user will be able to find the food truck that suits them at that moment. There is also the other side of the site that allows food truck owners to advertise their business and location in order to receive more traffic and to inform new "eaters" of their business. </p>
				</div>

			<hr>
			<h2>Persona for company worker</h2>
			<p>NAME: Freddy foodtuck</p>
			<p>AGE:22</p>
			<p>PROFESSION: Student and working part time as a food truck driver & cashier</p>
			<p>TECHNOLOGY: Using a Andriod smartphone</p>
			<p>ATTITUDES & BEHAVIORS: Freddy is going to school and working part time as a food truck minion. Time is always of the essence, so he can't be wasting any trying to sign into an application and broadcast his location.</p>
			<p>FRUSTRATIONS & NEEDS: Freddy needs to waste as little time as possible logging into the application, and broadcasting his signal. Additionally, he has no interest in spending anything more than a couple minutes registering his account with the application. He needs to login, broadcast location, and start cooking food and helping customers</p>
			<p>GOALS: Freddy's goal is to have the process of using an application to broadcast his location take less than 20 seconds, so his boss knows he's working and where he is, and most importantly the customers know where he is.</p>
			<h2>Use Case</h2>
			<p> Freddy is going to school full time and working part time for a food truck company. He has very little time to set up the truck, prepare food, drive to the location and start serving customers. He needs a quick and efficient method of creating a profile in the application used by his boss which will allow him to login and broadcast his location.</p>
			<h2>User Story</h2>
			<ul>
				<li><strong>Who:</strong> Freddy Foodtruck</li>
				<li><strong>What:</strong> Works for a food truck company</li>
				<li><strong>When:</strong> All times of day, and various days of the week</li>
				<li><strong>Why:</strong> Because he needs to make money</li>
				<li><strong>Where:</strong> In a truck on his andriod smartphone</li>
			</ul>
			<h2>Interaction Flow</h2>
			<h4>Signing up for application</h4>
			<p>Admin/owner of company account will enter the email of the person they wish to grant a worker account. This will generate an email which is sent to the worker. Once they click on the email, the worker is redirected to a unique signup page where their email is already pre-loaded. They then fill in their name, password x2, and a phone number to create a worker account. Once they submit all this information, they will receive an email asking them to verify their account creation.</p>
			<h4>Using the application</h4>
			<p>worker will click on the </p>
			<hr>

			<h2>Persona, for someone who plans to eat at a food truck in the future.</h2>
			<p>Name:  Will B. Hungry</p>
			<p>Age:  29</p>
			<p>Profession:  Will is a history instructor at CNM.</p>
			<p>Technology:  Will always carries his Android smart phone in his pocket.  At home, he uses a Dell laptop running Linux.  His network connection at home is just fast enough for streaming movies, but is not extremely speedy.</p>
			<p>Attitudes and behaviors:  Will does not like to cook.  He loves eating at resturants and food trucks, both for the food and for the social atmosphere.  In the past, Will has really enjoyed eating from food trucks at music festivals, but he has not used a food truck in Albuquerque.</p>
			<p>Frustrations and needs:  Not only does Will hate to cook, but his apartment has a tiny kitchen which is too cramped to prepare anything except coffee.  Will has a few favorite resturants in Albuquerque, but he wants to try new resturants and he is hoping to find some good food trucks in town.  To find food trucks, he could simply Google "food trucks Albuquerque", but then he would have to wade through each food truck's website, looking for the type of food they serve, and trying to find their schedule of days, times and locations.</p>
			<p>Goals:  Will is going out with friends this Saturday night.  They plan to meet in the downtown area around 8 pm, and look for a late dinner.  Will suspects they can find food trucks downtown on a Saturday night, and he would like to learn where the food trucks will be located that night.  On Saturday afternoon, Will wants to use his laptop to find which trucks will be located in downtown Albuquerque that night, where exactly they will be parked, and what kind of food they will be serving.</p>

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


			<h2>ERD, diagram of database structure:</h2>
				<img src="images/erd 2nd example CrumbTrail.svg" alt="ERD" width="900px"/>
			<br>
		</main>
	</body>
</html>