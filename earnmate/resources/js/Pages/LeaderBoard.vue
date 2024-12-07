<script setup>
import MyLayout from '@/Layouts/MyLayout.vue';
const props = defineProps({
  users: Array
});
function extractDate(datetime) {
  const date = new Date(datetime);
  return date.toISOString().split('T')[0];
}
</script>


<template>
  <MyLayout>
    <div class="relative w-full z-0  pt-36 md:px-32 lg:px-48">
      <!-- Background Blur Effect -->
      <div
        class="absolute -z-10 h-52 w-52 top-10 right-1/2 transform translate-x-1/2 bg-violet-500 rounded-full blur-[200px]">
      </div>

      <div class="z-30 w-full h-full">
        <div class="flex items-end justify-center w-full ">
          <div
            class="relative h-52 w-56 bg-white rounded-t-3xl shadow-custom-purple-top-left border-2 border-b-0 border-transparent">
            <div
              class="absolute inset-0 -z-10 bg-gradient-to-r from-yellow-400 via-orange-400 to-yellow-400 rounded-t-3xl p-[2px]">
              <div class="bg-white h-full w-full rounded-t-3xl"></div>
            </div>

            <div class="absolute md:w-fit w-32  top-[-1.5rem] left-2/3 md:left-1/2 transform -translate-x-1/2">
              <span class="inline-block  px-3 py-1 text-sm font-bold text-white bg-yellow-500 rounded-full">
                3rd Place
              </span>
            </div>

            <div class="flex flex-col space-y-2 items-start px-5 justify-center h-full">
              <p class="text-3xl font-bold text-gray-700 w-full text-center overflow-hidden">
                {{ users[2].name }}
              </p>
              <p class="text-base text-gray-600">Withdrawed: $ {{ users[2].withdrawed }}</p>
              <p class="text-base hidden md:block text-gray-600">Balance: $ {{ users[2].balance }} </p>
              <p class="text-base hidden md:block text-gray-600">Invited: {{ users[2].friends.length }} person</p>
            </div>
          </div>

          <!-- First Place -->
          <div
            class="relative h-72 w-64 rounded-t-3xl shadow-custom-purple-top-middle border-2 border-b-0  border-slate-300 bg-white">
            <!-- Crown -->
            <div class="absolute top-[-4rem] md:top-[-6rem] left-1/2 transform -translate-x-1/2">
              <img src="/imgs/crown.png" alt="Crown" class="w-32 scale-150 bg-transparent " />
            </div>
            <div class="flex flex-col items-start px-5 space-y-3 justify-center h-full">
              <p class="text-4xl font-bold text-gray-700 w-full text-center overflow-hidden">{{ users[0].name }}</p>
              <p class="text-lg text-gray-600">Withdrawed: ${{ users[0].withdrawed }}</p>
              <p class="text-lg hidden md:block text-gray-600">Balance: $ {{ users[0].balance }} </p>
              <p class="text-lg hidden md:block text-gray-600">Invited: {{ users[0].friends.length }} person</p>
            </div>
          </div>

          <!-- Second Place -->
          <div
            class="relative h-60 w-56 rounded-t-3xl shadow-custom-purple-top-right  border-2 border-b-0 border-slate-300 bg-white">
            <!-- Badge -->
            <div class="absolute md:w-fit w-32  top-[-1.5rem] left-2/3 md:left-1/2 transform -translate-x-1/2">
              <span class="inline-block px-3 py-1 text-sm font-bold text-white bg-gray-500 rounded-full">
                2nd Place
              </span>
            </div>
            <div class="flex flex-col items-start px-5 space-y-3 justify-center h-full">
              <p class="text-3xl font-bold text-gray-700 w-full text-center overflow-hidden">{{ users[1].name }}</p>
              <p class="text-base text-gray-600">Withdrawed: ${{ users[1].withdrawed }}</p>
              <p class="text-base hidden md:block text-gray-600">Balance: ${{ users[1].balance }} </p>
              <p class="text-base hidden md:block text-gray-600">Invited: {{ users[1].friends.length }} person</p>
            </div>
          </div>
        </div>
        <div class="z-10 bg-white shadow-custom-purple w-full  md:rounded-xl ">
          <div class="overflow-x-auto w-full">
            <table class="w-full text-center  ">
              <thead>
                <tr class="  bg-[#c3aae133] text-gray-700">
                  <th class="px-4 py-2">Name</th>
                <th class="px-4   py-2">Balance</th>
                <th class="px-4 table-cell  py-2">Joined</th>
                <th class="px-4 hidden md:table-cell  py-2">Current Level</th>
                <th class="px-4 py-2">Withdrawed</th>
                <th class="px-4  py-2">Friends</th>
              </tr>
            </thead>
              <tbody>
                <tr v-for="user in users.slice(3)" :key="user.id" class=" text-gray-600">
                  <td class="px-4 py-2">{{ user.name }}</td>
                  <td class="px-4 py-2">$ {{ user.balance }}</td>
                  <td class="px-4 table-cell py-2">{{ extractDate(user.created_at) }}</td>
                  <td class="px-4 hidden md:table-cell  py-2">{{ user.current_level.level ?
                    user.current_level.level.level_number : 'Not subscribed' }}</td>
                  <td class="px-4 py-2">$ {{ user.withdrawed }}</td>
                  <td class="px-4 py-2">{{ user.friends.length }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>


  </MyLayout>
</template>
