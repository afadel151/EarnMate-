<script setup>
import MyLayout from '@/Layouts/MyLayout.vue';
const props = defineProps({
    users: Array
});
</script>


<template>
    <MyLayout>
        <div class="relative w-full z-0 p-10 pt-36 md:px-32 lg:px-48">
  <!-- Background Blur Effect -->
  <div class="absolute -z-10 h-52 w-52 top-10 right-1/2 transform translate-x-1/2 bg-violet-500 rounded-full blur-[200px]"></div>

  <div class="z-30 w-full h-full">
    <!-- Top 3 Users Section -->
    <div class="flex items-end justify-center gap-12">
      <!-- Third Place -->
      <div class="relative h-52 w-44 rounded-t-xl shadow-md  border-slate-200 bg-violet-100">
        <!-- Badge -->
        <div class="absolute top-[-1.5rem] left-1/2 transform -translate-x-1/2">
          <span class="inline-block px-3 py-1 text-sm font-bold text-white bg-yellow-500 rounded-full">
            3rd Place
          </span>
        </div>
        <div class="flex flex-col items-center justify-center h-full">
          <p class="text-lg font-bold text-gray-700">{{ users[2].name }}</p>
          <p class="text-base text-gray-600">Balance: {{ users[2].balance }} DZD</p>
        </div>
      </div>

      <!-- First Place -->
      <div class="relative h-72 w-52 rounded-t-xl shadow-md  border-slate-400 bg-violet-300">
        <!-- Crown -->
        <div class="absolute top-[-6rem] left-1/2 transform -translate-x-1/2">
          <img src="/imgs/crown.png" alt="Crown" class="w-32 scale-150 bg-transparent " />
        </div>
        <div class="flex flex-col items-center justify-center h-full">
          <p class="text-xl font-bold text-gray-700">🏆 {{ users[0].name }}</p>
          <p class="text-lg text-gray-600">Balance: {{ users[0].balance }} DZD</p>
        </div>
      </div>

      <!-- Second Place -->
      <div class="relative h-60 w-48 rounded-t-xl shadow-md  border-slate-300 bg-violet-200">
        <!-- Badge -->
        <div class="absolute top-[-1.5rem] left-1/2 transform -translate-x-1/2">
          <span class="inline-block px-3 py-1 text-sm font-bold text-white bg-gray-500 rounded-full">
            2nd Place
          </span>
        </div>
        <div class="flex flex-col items-center justify-center h-full">
          <p class="text-lg font-bold text-gray-700">{{ users[1].name }}</p>
          <p class="text-base text-gray-600">Balance: {{ users[1].balance }} DZD</p>
        </div>
      </div>
    </div>

    <!-- Leaderboard Table -->
    <div class="mt-5 bg-indigo-100 p-8 rounded-xl shadow-md">
      <h2 class="text-2xl font-bold text-gray-700 mb-4">Leaderboard</h2>
      <div class="overflow-x-auto rounded-md">
        <table class="w-full text-center  rounded-xl">
          <thead>
            <tr class="bg-indigo-200 rounded-xl text-gray-700">
              <th class="px-4 py-2  -gray-300">Name</th>
              <th class="px-4 py-2  -gray-300">Email</th>
              <th class="px-4 py-2  -gray-300">Balance</th>
              <th class="px-4 py-2  -gray-300">Created At</th>
              <th class="px-4 py-2  -gray-300">Current Level</th>
              <th class="px-4 py-2  -gray-300">Withdrawed</th>
              <th class="px-4 py-2  -gray-300">Friends</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="user in users.slice(3)"
              :key="user.id"
              class="even:bg-indigo-50 odd:bg-white text-gray-600"
            >
              <td class="px-4 py-2  ">{{ user.name }}</td>
              <td class="px-4 py-2  ">{{ user.email }}</td>
              <td class="px-4 py-2  ">{{ user.balance }}</td>
              <td class="px-4 py-2  ">{{ user.created_at }}</td>
              <td class="px-4 py-2  ">{{ user.current_level.level ? user.current_level.level.level_number : 'Not subscribed' }}</td>
              <td class="px-4 py-2  ">{{ user.withdrawed }}</td>
              <td class="px-4 py-2  ">{{ user.friends.length }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


    </MyLayout>
</template>
