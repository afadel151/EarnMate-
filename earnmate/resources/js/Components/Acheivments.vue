<template>
    <div class="w-screen pt-24 px-80    bg-home2-bg bg-no-repeat bg-cover bg-[#dddeff] ">
        <p class="text-5xl font-light text-center ">Achievments</p>
        <div class="w-full flex justify-around mt-24 items-center">
            <p id="pub" class="bg-gradient-to-t from-[#6a38ff] to-[#6a38ff]/0 text-transparent bg-clip-text text-8xl font-black" >{{ tweened.pub.toFixed(0) }}+</p>
            <p id="users" class="bg-gradient-to-b from-[#fbaf00]/0 to-[#fbaf00] text-transparent bg-clip-text text-8xl font-black" >{{ tweened.users.toFixed(0) }}+</p>
            <p id="adv" class="bg-gradient-to-t from-[#1dd3b0]/0 to-[#1dd3b0] text-transparent bg-clip-text text-8xl font-black" >{{ tweened.adv.toFixed(0) }}+</p>

        </div>
    </div>
</template>

<script setup>


import { ref, reactive, onMounted } from 'vue'
import gsap from 'gsap'

const p = ref(2000)
const u = ref(9000)
const a = ref(600)
const tweened = reactive({
  pub: 0,
  users: 0,
  adv: 0
})

onMounted(() => {
  // Helper function to observe an element and animate it
  const animateOnView = (elementId, targetValue, tweenedProperty) => {
    const element = document.getElementById(elementId)
    if (!element) return

    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          // Start the GSAP animation once the element is visible
          gsap.to(tweened, { duration: 2, [tweenedProperty]: targetValue.value })
          observer.unobserve(entry.target) // Unobserve once animated
        }
      })
    }, { threshold: 0.1 }) // Adjust threshold as needed
    
    observer.observe(element)
  }

  // Observe each element with its specific target value and property in `tweened`
  animateOnView('pub', p, 'pub')
  animateOnView('users', u, 'users')
  animateOnView('adv', a, 'adv')
})
</script>