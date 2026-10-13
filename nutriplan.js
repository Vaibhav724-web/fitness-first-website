let dailyCalories = 2000;
let dailyProtein = 150;
let dailyCarbs = 200;
let dailyFat = 70;
let foodLog = [];
let consumedNutrition = { calories: 0, protein: 0, carbs: 0, fat: 0 };

const API_BASE = "api/";

function capitalize(s) { if (!s) return s; return s.charAt(0).toUpperCase() + s.slice(1); }
function escapeHtml(text) { const map={"&":"&amp;","<":"&lt;",">":"&gt;","\"":"&quot;","'":"&#039;"}; return String(text).replace(/[&<>"']/g,(m)=>map[m]); }
function roundTo(num, dec) { const mult = Math.pow(10, dec); return Math.round(num * mult) / mult; }

function generateMockRecipes(searchTerm) {
  const images = [
    "https://images.unsplash.com/photo-1511690743698-d9d85f2fbf38?w=800&q=80",
    "https://images.unsplash.com/photo-1498837167922-ddd27525d352?w=800&q=80",
    "https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=800&q=80",
    "https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?w=800&q=80",
  ];
  const base = [
    { label: `${capitalize(searchTerm)} Power Bowl`, calories: 420, protein: 28, carbs: 45, fat: 12 },
    { label: `${capitalize(searchTerm)} Salad`, calories: 320, protein: 12, carbs: 30, fat: 18 },
    { label: `Grilled ${capitalize(searchTerm)} with Veggies`, calories: 480, protein: 38, carbs: 35, fat: 20 },
    { label: `${capitalize(searchTerm)} Stir Fry`, calories: 390, protein: 24, carbs: 50, fat: 10 },
  ];
  return base.map((r, i) => ({
    label: r.label,
    image: images[i % images.length],
    source: "NutriPlan Demo",
    url: "#",
    calories: r.calories, protein: r.protein, carbs: r.carbs, fat: r.fat,
    ingredients: [`${Math.max(50, 100 - i * 5)}g ${searchTerm}`, "1 tbsp olive oil", "Mixed greens", "Salt & pepper"],
  }));
}

function displayRecipes(recipes) {
  const container = document.getElementById("recipe-results");
  container.innerHTML = "";
  if (!recipes || recipes.length === 0) {
    container.innerHTML = '<p class="text-center text-white-50 col-span-full">No recipes found.</p>';
    return;
  }
  recipes.forEach((recipe) => {
    const card = document.createElement("div");
    card.className = "meal-card rounded-xl p-0 overflow-hidden card-hover";
    card.innerHTML = `
      <div class="relative">
        <img src="${recipe.image}" alt="${escapeHtml(recipe.label)}" class="w-full h-44 object-cover">
        <div class="absolute left-4 bottom-4 bg-white/10 backdrop-blur-sm py-2 px-3 rounded-full text-white text-sm font-medium">${recipe.source}</div>
      </div>
      <div class="p-4">
        <h4 class="text-white font-semibold text-lg mb-2">${escapeHtml(recipe.label)}</h4>
        <p class="text-gray-200 text-sm mb-3">Approx: ${recipe.calories} kcal • ${recipe.protein}g P • ${recipe.carbs}g C • ${recipe.fat}g F</p>
        <div class="flex gap-2">
          <button class="add-to-log-btn flex-1 bg-green-500 hover:bg-green-600 text-white py-2 rounded-lg text-sm font-semibold">Add to Log</button>
          <a href="${recipe.url}" target="_blank" class="flex-1 text-center underline text-sm text-white/90 py-2 rounded-lg border border-white/10">View</a>
        </div>
      </div>`;
    card.querySelector(".add-to-log-btn").addEventListener("click", () => {
      addFoodItem({
        name: recipe.label, calories: recipe.calories, protein: recipe.protein,
        carbs: recipe.carbs, fat: recipe.fat, quantity: 1, timestamp: Date.now(),
      });
    });
    container.appendChild(card);
  });
}

const mockFoodDB = {
  apple: { calories: 52, protein: 0.3, carbs: 14, fat: 0.2 },
  banana: { calories: 89, protein: 1.1, carbs: 23, fat: 0.3 },
  "chicken breast": { calories: 165, protein: 31, carbs: 0, fat: 3.6 },
  rice: { calories: 130, protein: 2.4, carbs: 28, fat: 0.3 },
  egg: { calories: 155, protein: 13, carbs: 1.1, fat: 11 },
  almonds: { calories: 579, protein: 21, carbs: 22, fat: 50 },
  oats: { calories: 389, protein: 17, carbs: 66, fat: 7 },
  quinoa: { calories: 120, protein: 4.1, carbs: 21, fat: 1.9 },
};

async function persistFoodItemToServer(item) {
  const res = await fetch(API_BASE + "food_log_add.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      name: item.name, calories: item.calories, protein: item.protein,
      carbs: item.carbs, fat: item.fat, quantity: item.quantity || 0
    })
  });
  const data = await res.json();
  if (!res.ok || !data.ok) throw new Error(data.error || "Add failed");
  return data;
}
async function fetchFoodLogFromServer() {
  const res = await fetch(API_BASE + "food_log_list.php");
  const data = await res.json();
  if (!res.ok || !data.ok) throw new Error(data.error || "Fetch failed");
  return data;
}
async function deleteFoodLogItemFromServer(id) {
  const res = await fetch(API_BASE + "food_log_delete.php", {
    method: "POST", headers: { "Content-Type": "application/json" }, body: JSON.stringify({ id })
  });
  const data = await res.json();
  if (!res.ok || !data.ok) throw new Error(data.error || "Delete failed");
  return data;
}
async function clearFoodLogOnServer() {
  const res = await fetch(API_BASE + "food_log_delete.php?all=1");
  const data = await res.json();
  if (!res.ok || !data.ok) throw new Error(data.error || "Clear failed");
  return data;
}

async function addFoodItem(item) {
  try {
    const { entry, totals } = await persistFoodItemToServer(item);
    foodLog.push({ ...item, id: entry.id });
    consumedNutrition.calories = totals.calories;
    consumedNutrition.protein = totals.protein;
    consumedNutrition.carbs = totals.carbs;
    consumedNutrition.fat = totals.fat;
    renderFoodLog(); updateNutritionProgress();
    const el = document.getElementById("consumed-calories");
    el.classList.add("animate-pulse-slow"); setTimeout(() => el.classList.remove("animate-pulse-slow"), 800);
  } catch (e) {
    alert("Please login to save your food log."); console.error(e);
  }
}

function renderFoodLog() {
  const logEl = document.getElementById("food-log");
  logEl.innerHTML = "";
  if (foodLog.length === 0) {
    logEl.innerHTML = '<p class="text-gray-400 text-center py-8">No food items logged yet. Start by adding some food above!</p>';
    return;
  }
  foodLog.slice().reverse().forEach((f, idx) => {
    const item = document.createElement("div");
    item.className = "flex items-center justify-between bg-white/5 p-3 rounded-lg";
    item.innerHTML = `
      <div>
        <div class="text-white font-medium">${escapeHtml(f.name)}</div>
        <div class="text-gray-300 text-sm">${f.quantity ? f.quantity + "g" : ""} • ${f.calories} kcal • ${f.protein}g P</div>
      </div>
      <div class="flex items-center gap-2">
        <button class="text-sm text-gray-300 remove-btn">Remove</button>
      </div>`;
    item.querySelector(".remove-btn").addEventListener("click", async () => {
      const realIndex = foodLog.length - 1 - idx;
      await removeFoodItem(realIndex);
    });
    logEl.appendChild(item);
  });
}

async function removeFoodItem(index) {
  if (index < 0 || index >= foodLog.length) return;
  const f = foodLog[index];
  try {
    if (f.id) { await deleteFoodLogItemFromServer(f.id); }
    foodLog.splice(index, 1);
    consumedNutrition.calories = Math.max(0, consumedNutrition.calories - Number(f.calories));
    consumedNutrition.protein = Math.max(0, consumedNutrition.protein - Number(f.protein));
    consumedNutrition.carbs = Math.max(0, consumedNutrition.carbs - Number(f.carbs));
    consumedNutrition.fat = Math.max(0, consumedNutrition.fat - Number(f.fat));
    renderFoodLog(); updateNutritionProgress();
  } catch (e) { alert("Could not remove this item."); console.error(e); }
}

async function clearFoodLog() {
  if (!confirm("Clear the entire food log?")) return;
  try { await clearFoodLogOnServer(); } catch (e) { console.warn("Server clear failed", e); }
  foodLog = []; consumedNutrition = { calories: 0, protein: 0, carbs: 0, fat: 0 };
  renderFoodLog(); updateNutritionProgress();
}

function updateNutritionProgress() {
  const calGoal = dailyCalories || 2000, proteinGoal = dailyProtein || 150, carbsGoal = dailyCarbs || 200, fatGoal = dailyFat || 70;
  document.getElementById("consumed-calories").textContent = consumedNutrition.calories;
  document.getElementById("consumed-protein").textContent = `${Math.round(consumedNutrition.protein)}g`;
  document.getElementById("consumed-carbs").textContent = `${Math.round(consumedNutrition.carbs)}g`;
  document.getElementById("consumed-fat").textContent = `${Math.round(consumedNutrition.fat)}g`;
  const calPercent = Math.min(100, Math.round((consumedNutrition.calories / calGoal) * 100));
  document.getElementById("calorie-progress").textContent = `${consumedNutrition.calories} / ${calGoal} kcal`;
  document.getElementById("calorie-progress-bar").style.width = `${calPercent}%`;
  const proteinEl = document.getElementById("protein-bar");
  const carbsEl = document.getElementById("carbs-bar");
  const fatEl = document.getElementById("fat-bar");
  if (proteinEl && carbsEl && fatEl) {
    proteinEl.style.width = `${Math.min(100, Math.round((consumedNutrition.protein / proteinGoal) * 100))}%`;
    carbsEl.style.width = `${Math.min(100, Math.round((consumedNutrition.carbs / carbsGoal) * 100))}%`;
    fatEl.style.width = `${Math.min(100, Math.round((consumedNutrition.fat / fatGoal) * 100))}%`;
  }
}

async function loadState() {
  try {
    const data = await fetchFoodLogFromServer();
    foodLog = data.items || [];
    consumedNutrition = {
      calories: data.totals?.calories || 0,
      protein: data.totals?.protein || 0,
      carbs: data.totals?.carbs || 0,
      fat: data.totals?.fat || 0
    };
  } catch (e) {
    foodLog = []; consumedNutrition = { calories: 0, protein: 0, carbs: 0, fat: 0 };
  }
}

async function searchRecipesWrapper(q) {
  document.getElementById("recipe-loading").classList.remove("hidden");
  document.getElementById("recipe-results").innerHTML = "";
  try {
    await new Promise((r) => setTimeout(r, 600));
    const recipes = generateMockRecipes(q);
    displayRecipes(recipes);
  } finally {
    document.getElementById("recipe-loading").classList.add("hidden");
  }
}
async function searchRecipes(query = null) {
  const searchTerm = query || document.getElementById("recipe-search").value.trim();
  if (!searchTerm) { alert("Please enter a search term"); return; }
  await searchRecipesWrapper(searchTerm);
}
function quickRecipeSearch(term) {
  document.getElementById("recipe-search").value = term;
  searchRecipes(term);
}

document.addEventListener("DOMContentLoaded", async function () {
  await loadState();
  renderFoodLog();
  updateNutritionProgress();
  const rs = document.getElementById("recipe-search");
  if (rs) rs.addEventListener("keypress", (e) => { if (e.key === "Enter") searchRecipes(); });
  const fs = document.getElementById("food-search");
  if (fs) fs.addEventListener("keypress", (e) => { if (e.key === "Enter") searchFood(); });
});

function searchFood() {
  const query = document.getElementById("food-search").value.trim().toLowerCase();
  const qty = parseFloat(document.getElementById("food-quantity").value) || 100;
  if (!query) { alert("Please enter a food name to add."); return; }
  let entry;
  if (mockFoodDB[query]) {
    const per100 = mockFoodDB[query];
    const factor = qty / 100.0;
    entry = {
      name: capitalize(query),
      calories: Math.round(per100.calories * factor),
      protein: roundTo(per100.protein * factor, 1),
      carbs: roundTo(per100.carbs * factor, 1),
      fat: roundTo(per100.fat * factor, 1),
      quantity: qty,
      timestamp: Date.now(),
    };
  } else {
    const factor = qty / 100.0;
    entry = { name: capitalize(query), calories: Math.round(150 * factor), protein: roundTo(5 * factor, 1), carbs: roundTo(20 * factor, 1), fat: roundTo(7 * factor, 1), quantity: qty, timestamp: Date.now() };
  }
  addFoodItem(entry);
  document.getElementById("food-search").value = "";
  document.getElementById("food-quantity").value = "";
}