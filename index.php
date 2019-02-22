<?php
include("includes/config.php");

//session_destroy();

if (isset($_SESSION['userLoggedIn'])) {
	$userLoggedIn = $_SESSION['userLoggedIn'];
}
else{
	header("Location: register.php");
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>andMusic - Your AI Based Music Store</title>
	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
	<div id="mainContainer">

		<div id="topContainer">
			<h1>Hello xyz</h1>
			<?php echo $userLoggedIn ?>
			<a href="logout.php">Logout</a>
		</div>
	
		<div id="nowPlayingBarContainer">
			
			<div id="nowPlayingBar">
				<div id="nowPlayingLeft">
					<div class="content">
						<span class="albumLink">
							<img src="assets/images/Artwork/artwork.jpg" class="albumArtwork">
						</span>

						<div class="trackInfo">
							<span class="trackName">
								<span>Children of song</span>
							</span>

							<span class="artistName">
								<span>Krishna Jha</span>
							</span>
						</div>
					</div>
				</div>

				<div id="nowPlayingCenter">
					<div class="content playerControls">
						<div class="buttons">

							<button class="controlButton shuffle" title="Shuffle">							
								<img src="assets/images/icons/shuffle-white.png" alt="Shuffle">
							</button>

							<button class="controlButton previous" title="Previous">						
								<img src="assets/images/icons/previous-white.png" alt="Previous">
							</button>

							<button class="controlButton play" title="Play">							
								<img src="assets/images/icons/play-white.png" alt="Play">
							</button>

							<button class="controlButton pause" title="Pause" style="display: none;">							
								<img src="assets/images/icons/pause-white.png" alt="Pause">
							</button>

							<button class="controlButton next" title="Next">							
								<img src="assets/images/icons/next-white.png" alt="Next">
							</button>

							<button class="controlButton repeat" title="Repeat">							
								<img src="assets/images/icons/repeat-white.png" alt="Repeat">
							</button>

						</div>

						<div class="playbackBar">
							<span class="progressTime current">0.00</span>

							<div class="progressBar">
								<div class="progressBarBg">
									<div class="progress"></div>
								</div>
							</div>

							<span class="progressTime remaining">0.00</span>
						</div>

					</div>
				</div>

				<div id="nowPlayingRight">
					
					<div class="volumeBar">
						
						<button class="controlButton volume" title="Volume">
							<img src="assets/images/icons/sound-white.png" alt="Volume">
						</button>

						<div class="progressBar">
							<div class="progressBarBg">
								<div class="progress"></div>
							</div>
						</div>

					</div>

				</div>
			</div>

		</div>
	</div>

</body>
</html>