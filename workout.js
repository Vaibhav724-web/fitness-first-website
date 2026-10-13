// Workouts Data
const workouts = {
  monday: [
    { name: "Bench Press", img: "benchpress.jpg", info: "3 sets of 10 reps. Focus on chest contraction. " },
    { name: "Incline Dumbbell Press", img: "inclinedumbellpress.jpg", info: "3 sets of 12 reps. Target upper chest." },
    { name: "Push-Ups", img: "pushups.jpg", info: "4 sets till failure. Great bodyweight exercise." },
    { name: "Chest Fly", img: "chestfly.jpg", info: "3 sets of 12 reps. Works inner chest." },
    { name: "Decline Bench Press", img: "declinebenchpress.jpg", info: "3 sets of 10 reps. Focuses on lower chest." },
    { name: "Cable Crossover", img: "cablecrossover.jpg", info: "3 sets of 15 reps. Adds definition." },
    { name: "Dumbbell Pullover", img: "dumbellpullover.jpg", info: "3 sets of 10 reps. Expands chest & ribcage." },
    { name: "Machine Chest Press", img: "machinechestpress.jpg", info: "3 sets of 12 reps. Safer isolation move." },
    { name: "Wide Push-Ups", img: "widepushups.jpg", info: "4 sets till failure. Emphasizes outer chest." },
    { name: "Clap Push-Ups", img: "clappushups.jpg", info: "Explosive bodyweight chest workout." }
  ],
  tuesday: [
    { name: "Shoulder Press", img: "shoulderpress.jpg", info: "3 sets of 10 reps. Builds overall shoulder strength." },
    { name: "Lateral Raises", img: "lateralraises.jpg", info: "3 sets of 12 reps. Focus on side delts." },
    { name: "Front Raises", img: "frontraises.jpg", info: "3 sets of 12 reps. Strengthens front delts." },
    { name: "Arnold Press", img: "arnoldpress.jpg", info: "3 sets of 12 reps. Full shoulder activation." },
    { name: "Rear Delt Fly", img: "reardeltfly.jpg", info: "3 sets of 12 reps. Targets rear delts." },
    { name: "Face Pulls", img: "facepulls.jpg", info: "3 sets of 15 reps. Improves posture." },
    { name: "Shrugs", img: "shrugs.jpg", info: "4 sets of 15 reps. Builds traps." },
    { name: "Barbell Overhead Press", img: "barbelloverheadpress.jpg", info: "4 sets of 8 reps. Power exercise." },
    { name: "Upright Rows", img: "uprightrows.jpg", info: "3 sets of 12 reps. Works traps & shoulders." },
    { name: "Pike Push-Ups", img: "pikepushups.jpg", info: "3 sets till failure. Bodyweight shoulder builder." }
  ],
  wednesday: [
    { name: "Pull-Ups", img: "pullups.jpg", info: "3 sets till failure. Great for back width." },
    { name: "Deadlift", img: "deadlift.jpg", info: "4 sets of 8 reps. Builds overall strength." },
    { name: "Barbell Row", img: "barbellrow.jpg", info: "3 sets of 10 reps. Works mid-back." },
    { name: "Lat Pulldown", img: "latpulldown.jpg", info: "3 sets of 12 reps. Isolates lats." },
    { name: "T-Bar Row", img: "tbarrow.jpg", info: "3 sets of 12 reps. Builds thickness." },
    { name: "Seated Cable Row", img: "seatedcablerow.jpg", info: "3 sets of 12 reps. Good contraction." },
    { name: "Chin-Ups", img: "chinups.jpg", info: "3 sets till failure. Works lats and biceps." },
    { name: "Hyperextensions", img: "hyperextensions.jpg", info: "3 sets of 15 reps. Strengthens lower back." },
    { name: "Dumbbell Row", img: "dumbellrow.jpg", info: "3 sets of 12 reps. Isolates each side." },
    { name: "Inverted Rows", img: "invertedrows.jpg", info: "3 sets till failure. Bodyweight back exercise." }
  ],
  thursday: [
    { name: "Squats", img: "squats.jpg", info: "4 sets of 10 reps. King of leg workouts." },
    { name: "Lunges", img: "lunges.jpg", info: "3 sets of 12 reps each leg. Builds balance." },
    { name: "Leg Press", img: "legpress.jpg", info: "4 sets of 10 reps. Strengthens quads." },
    { name: "Romanian Deadlift", img: "romaniandeadlift.jpg", info: "3 sets of 10 reps. Targets hamstrings." },
    { name: "Leg Extensions", img: "legextensions.jpg", info: "3 sets of 12 reps. Focus on quads." },
    { name: "Hamstring Curls", img: "hamstringcurls.jpg", info: "3 sets of 12 reps. Strengthens hamstrings." },
    { name: "Calf Raises", img: "calfraises.jpg", info: "4 sets of 20 reps. Builds calves." },
    { name: "Bulgarian Split Squats", img: "bulgariansplitsquats.jpg", info: "3 sets of 12 reps per leg." },
    { name: "Step-Ups", img: "stepups.jpg", info: "3 sets of 15 reps. Builds explosiveness." },
    { name: "Glute Bridges", img: "glutebridges.jpg", info: "3 sets of 15 reps. Strengthens glutes." }
  ],
  friday: [
    { name: "Bicep Curls", img: "bicepcurls.jpg", info: "3 sets of 12 reps. Focus on form." },
    { name: "Tricep Dips", img: "tricepdips.jpg", info: "3 sets of 15 reps. Bodyweight tricep exercise." },
    { name: "Hammer Curls", img: "hammercurls.jpg", info: "3 sets of 12 reps. Targets forearms too." },
    { name: "Skull Crushers", img: "skullcrushers.jpg", info: "3 sets of 10 reps. Great for triceps." },
    { name: "Concentration Curls", img: "concentrationcurls.jpg", info: "3 sets of 12 reps. Isolates biceps." },
    { name: "Close Grip Bench Press", img: "closegripbenchpress.jpg", info: "3 sets of 10 reps. Triceps-focused press." },
    { name: "Cable Pushdowns", img: "cablepushdowns.jpg", info: "3 sets of 12 reps. Isolates triceps." },
    { name: "Incline Dumbbell Curl", img: "inclinedumbellcurl.jpg", info: "3 sets of 12 reps. Stretches biceps." },
    { name: "Overhead Tricep Extension", img: "overheadtricepextension.jpg", info: "3 sets of 12 reps. Works long head of triceps." },
    { name: "Zottman Curls", img: "zottmancurls.jpg", info: "3 sets of 12 reps. Biceps + forearms." }
  ],
  saturday: [
    { name: "Running", img: "running.jpg", info: "20 minutes steady pace. Improves stamina." },
    { name: "Cycling", img: "cycling.jpg", info: "30 minutes outdoor/indoor cycling." },
    { name: "Jump Rope", img: "jumprope.jpg", info: "5 sets of 2 minutes each. Great cardio burn." },
    { name: "Burpees", img: "burpees.jpg", info: "3 sets of 15 reps. High intensity." },
    { name: "Mountain Climbers", img: "mountainclimbers.jpg", info: "3 sets of 30 seconds. Great HIIT." },
    { name: "High Knees", img: "highknees.jpg", info: "3 sets of 30 seconds. Boosts heart rate." },
    { name: "Sprinting", img: "sprinting.jpg", info: "10 × 100m sprints. Explosive training." },
    { name: "Rowing Machine", img: "rowingmachine.jpg", info: "15 minutes steady row." },
    { name: "Stair Climbing", img: "stairclimbing.jpg", info: "10 minutes stair climbing." },
    { name: "Shadow Boxing", img: "shadowboxing.jpg", info: "3 sets of 2 min. Fun cardio workout." }
  ],
  sunday: [
    { name: "Yoga", img: "yoga.jpg", info: "30 minutes. Improves flexibility & relaxation." },
    { name: "Stretching", img: "stretching.jpg", info: "15 minutes full-body stretches." },
    { name: "Meditation", img: "meditation.jpg", info: "10 minutes deep breathing for recovery." },
    { name: "Foam Rolling", img: "foamrolling.jpg", info: "10 minutes. Relieves muscle tightness." },
    { name: "Breathing Exercises", img: "breathing.jpg", info: "5 minutes. Calms the nervous system." },
    { name: "Light Walk", img: "lightwalk.jpg", info: "20 minutes. Active recovery." },
    { name: "Mobility Drills", img: "mobilitydrills.jpg", info: "15 minutes. Keeps joints healthy." },
    { name: "Pilates", img: "pilates.jpg", info: "30 minutes. Core strength and flexibility." },
    { name: "Tai Chi", img: "taichi.jpg", info: "20 minutes. Improves balance and focus." },
    { name: "Cold Stretching", img: "coldstretching.jpg", info: "10 minutes before bed. Relax muscles." }
  ]
};

// Function to show workouts
function showWorkout(day) {
  const container = document.getElementById("workout-container");
  container.innerHTML = "";

  workouts[day].forEach(workout => {
    const div = document.createElement("div");
    div.classList.add("workout");
    div.innerHTML = `
      <img src="${workout.img}" alt="${workout.name}">
      <h3><i class="fas fa-dumbbell"></i> ${workout.name}</h3>
      <p>${workout.info}</p>
    `;
    container.appendChild(div);
  });

  // Highlight active day
  document.querySelectorAll(".day-btn").forEach(btn => btn.classList.remove("active"));
  document.querySelector(`[onclick="showWorkout('${day}')"]`).classList.add("active");
}

function openModal(workout) {
  document.getElementById("modalTitle").textContent = workout.name;
  document.getElementById("modalInfo").textContent = workout.info;

  // render steps as bullet points
  const stepsContainer = document.getElementById("modalSteps");
  stepsContainer.innerHTML = "";
  workout.steps.forEach(step => {
    const li = document.createElement("li");
    li.textContent = step;
    stepsContainer.appendChild(li);
  });

  document.getElementById("workoutModal").style.display = "flex";
}
