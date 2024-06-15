<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyGameList</title>
    <link rel="stylesheet" href="mainstyles.css">
</head>
<body>
    <header>
        <div class="header-left">
            <button>Games</button>
            <button>Users</button>
        </div>
        <div class="header-middle">
            <h1 class="logo">MyGameList</h1>
        </div>
        <div class="header-right">
            <div class="language-selector">
                <select>
                    <option value="en">English</option>
                    <option value="lv">Latvian</option>
                    <option value="ru">Russian</option>
                </select>
            </div>
            <nav>
                <ul>
                    <li><a href="#">Game List</a></li>
                    <li><a href="#">Profile</a></li>
                    <li><a href="#">Exit</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="container">
        <h1>Welcome to the MyGameList website!</h1>
        <p>Here you can add games to your list and manage them.</p>

        <section class="top-games">
            <h2>Top 5 Games</h2>
            <ul>
                <li>
                    <img src="https://via.placeholder.com/100" alt="Game 1">
                    <div>
                        <h3>Game 1</h3>
                        <p>Grade: 9.5</p>
                    </div>
                </li>
                <li>
                    <img src="https://via.placeholder.com/100" alt="Game 2">
                    <div>
                        <h3>Game 2</h3>
                        <p>Grade: 9.2</p>
                    </div>
                </li>
                <li>
                    <img src="https://via.placeholder.com/100" alt="Game 3">
                    <div>
                        <h3>Game 3</h3>
                        <p>Grade: 9.0</p>
                    </div>
                </li>
                <li>
                    <img src="https://via.placeholder.com/100" alt="Game 4">
                    <div>
                        <h3>Game 4</h3>
                        <p>Grade: 8.8</p>
                    </div>
                </li>
                <li>
                    <img src="https://via.placeholder.com/100" alt="Game 5">
                    <div>
                        <h3>Game 5</h3>
                        <p>Grade: 8.7</p>
                    </div>
                </li>
            </ul>
        </section>

        <section class="best-of-the-best">
            <h2>Best of the Best</h2>
            <div class="best-game">
                <img src="https://via.placeholder.com/200" alt="Best Game">
                <div>
                    <h3>Best Game</h3>
                    <p>This game is the best of the best because...</p>
                </div>
            </div>
        </section>

		<section class="all-games">
		<h2>All Games</h2>
		<div class="game-gallery">
			<div class="game-item">
				<img src="https://via.placeholder.com/150" alt="Game 1">
				<h3>Game 1</h3>
			</div>
			<div class="game-item">
				<img src="https://via.placeholder.com/150" alt="Game 2">
				<h3>Game 2</h3>
			</div>
			<div class="game-item">
				<img src="https://via.placeholder.com/150" alt="Game 3">
				<h3>Game 3</h3>
			</div>
			
		</div>
		</section>
    </div>
</body>
</html>