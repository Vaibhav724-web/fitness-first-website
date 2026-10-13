<?php
// nutriplan.php (login आवश्यक नाही म्हटलं तरी, food log save साठी user_id सेशनमध्ये हवाच)
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>NutriPlan</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="nutriplan.css">
  <link rel="shortcut icon" href="assects/favicon.ico" type="image/x-icon">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link href="css/animate.css" rel="stylesheet">
  <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <nav class="navbar navbar-expand-md navbar-dark">
    <div class="container"> 
      <a class="navbar-brand mr-auto" href="index.php">
        <img src="images/logo.png" alt="FitnessFirst" />
      </a>     
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar"> 
        <span class="navbar-toggler-icon"></span> 
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"> <a class="nav-link" href="index.php">Home</a> </li>
          <li class="nav-item"> <a class="nav-link" href="#about-us">About</a> </li>
          <li class="nav-item"> <a class="nav-link" href="#contact">Contact</a> </li>
          <li class="nav-item"> <a class="nav-link" href="#planner">Workouts</a> </li>       
          <li class="nav-item"> <a class="nav-link" href="#recipes">Healthy Recipes</a> </li>
        </ul>
      </div>
    </div>
  </nav>

  <section id="home" class="pt-20 pb-16">
    <div class="container mx-auto px-4 text-center items-center">
      <div class="fade-in">
        <h1 class="text-5xl md:text-7xl font-bold text-white mb-6">
          Your Perfect <span class="text-green-400">Diet</span> Awaits
        </h1>
        <p class="text-xl text-gray-200 mb-8 max-w-2xl mx-auto">
          Create personalized meal plans, track nutrition, and discover delicious recipes tailored to your goals.
        </p>
      </div>
    </div>
  </section>

  <div class="glass-effect rounded-2xl p-8 mb-8 max-w-4xl mx-auto fade-in">
    <h3 class="text-2xl font-semibold text-white mb-6">Personal Diet Planner</h3>
    <form action="generate_diet.php" method="POST">
      <div class="mb-3">
        <label class="form-label text-white">Your Name</label>
        <input type="text" name="name" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label text-white">Age</label>
        <input type="number" name="age" class="form-control" placeholder="25" required>
      </div>
      <div class="mb-3">
        <label class="form-label text-white">Height (cm)</label>
        <input type="number" step="0.1" name="height" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label text-white">Weight (kg)</label>
        <input type="number" step="0.1" name="weight" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-success w-full">Generate Diet Plan</button>
    </form>
  </div>

  <!-- Recipe Search Section -->
  <section class="py-16" id="recipes">
    <div class="container mx-auto px-4">
      <div class="text-center mb-12">
        <h2 class="text-4xl font-bold text-white mb-4">Recipe <span class="bg-gradient-to-r from-green-400 via-emerald-500 to-teal-400 bg-clip-text text-transparent">Discovery</span></h2>
        <p class="text-gray-200 max-w-2xl mx-auto">Find healthy and delicious recipes that fit your diet plan</p>
      </div>

      <div class="glass-effect rounded-2xl p-8 mb-8 max-w-4xl mx-auto">
        <div class="flex flex-col md:flex-row gap-4">
          <input type="text" id="recipe-search" class="flex-1 px-4 py-3 rounded-lg bg-white/10 text-white placeholder-gray-400 border border-white/20 focus:border-green-400 focus:outline-none" placeholder="Search for recipes...">
          <button onclick="searchRecipes()" class="bg-green-500 hover:bg-green-600 text-white px-8 py-3 rounded-lg font-semibold transition-colors">
            <i class="fas fa-search mr-2"></i>Search Recipes
          </button>
        </div>
        <div class="flex flex-wrap gap-2 mt-6">
          <button onclick="quickRecipeSearch('chicken')" class="bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-full text-sm">Chicken</button>
          <button onclick="quickRecipeSearch('salad')" class="bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-full text-sm">Salads</button>
          <button onclick="quickRecipeSearch('vegetarian')" class="bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-full text-sm">Vegetarian</button>
          <button onclick="quickRecipeSearch('low carb')" class="bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-full text-sm">Low Carb</button>
          <button onclick="quickRecipeSearch('high protein')" class="bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-full text-sm">High Protein</button>
        </div>
      </div>

      <div id="recipe-loading" class="hidden text-center">
        <div class="loading-spinner mx-auto mb-4"></div>
        <p class="text-white">Searching for delicious recipes...</p>
      </div>

      <div id="recipe-results" class="grid md:grid-cols-2 lg:grid-cols-3 gap-8"></div>
    </div>
  </section>

  <!-- Nutrition Tracker -->
  <section class="py-16" id="nutrition">
    <div class="container mx-auto px-4">
      <div class="text-center mb-12">
        <h2 class="text-4xl font-bold text-white mb-4"><span class="bg-gradient-to-r from-green-400 via-emerald-500 to-teal-400 bg-clip-text text-transparent">Nutrition</span> Tracker</h2>
        <p class="text-gray-200 max-w-2xl mx-auto">Track your daily food intake and monitor your nutritional goals</p>
      </div>

      <div class="glass-effect rounded-2xl p-8 mb-8 max-w-4xl mx-auto">
        <h3 class="text-2xl font-semibold text-white mb-6">Add Food Item</h3>
        <div class="flex flex-col md:flex-row gap-4">
          <input type="text" id="food-search" placeholder="Search for food (e.g., apple, chicken breast)" class="flex-1 px-4 py-3 rounded-lg bg-white/10 text-white placeholder-gray-400 border border-white/20 focus:border-green-400">
          <input type="number" id="food-quantity" placeholder="Quantity (g)" min="1" class="w-32 px-4 py-3 rounded-lg bg-white/10 text-white placeholder-gray-400 border border-white/20 focus:border-green-400">
          <button onclick="searchFood()" class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold transition-colors"><i class="fas fa-plus mr-2"></i>Add Food</button>
        </div>
      </div>

      <div class="glass-effect rounded-2xl p-8 mb-8">
        <h3 class="text-2xl font-semibold text-white mb-6">Today's Progression</h3>
        <div class="grid md:grid-cols-4 gap-6 text-center">
          <div><div class="text-3xl font-bold text-green-400" id="consumed-calories">0</div><div class="text-gray-300 text-sm">Calories Consumed</div></div>
          <div><div class="text-2xl font-bold text-blue-400" id="consumed-protein">0g</div><div class="text-gray-300 text-sm">Protein</div></div>
          <div><div class="text-2xl font-bold text-yellow-400" id="consumed-carbs">0g</div><div class="text-gray-300 text-sm">Carbs</div></div>
          <div><div class="text-2xl font-bold text-red-400" id="consumed-fat">0g</div><div class="text-gray-300 text-sm">Fat</div></div>
        </div>
        <div class="mt-8 space-y-4">
          <div>
            <div class="flex justify-between text-white text-sm mb-1">
              <span>Daily Calorie Goal</span>
              <span id="calorie-progress">0 / 2000 kcal</span>
            </div>
            <div class="bg-white/20 rounded-full h-2">
              <div id="calorie-progress-bar" class="bg-green-500 h-2 rounded-full transition-all duration-500" style="width: 0%;"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="glass-effect rounded-2xl p-8">
        <div class="flex justify-between items-center mb-6">
          <h3 class="text-2xl font-semibold text-white">Food Log</h3>
          <button onclick="clearFoodLog()" class="text-red-400 hover:text-red-300 text-sm">
            <i class="fas fa-trash mr-1"></i>Clear Log
          </button>
        </div>
        <div id="food-log" class="space-y-3"></div>
      </div>
    </div>
  </section>

  <footer class="py-12 border-t border-white/10">
    <div class="container mx-auto px-4">
      <div class="text-center">
        <div class="text-white text-2xl font-bold mb-4 flex items-center justify-center">
          <i class="fas fa-leaf mr-2 text-green-400"></i>
          FitnessFirst
        </div>
        <p class="text-gray-300 mb-6">Your journey to better health starts here</p>
        <div class="flex justify-center space-x-6 mb-6">
          <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook text-xl"></i></a>
          <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter text-xl"></i></a>
          <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram text-xl"></i></a>
        </div>
        <p class="text-gray-300 text-sm">&copy; 2025 FitnessFirst. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <script src="nutriplan.js"></script>
</body>
</html>