<script setup>
import MyLayout from '@/Layouts/MyLayout.vue';
import { onMounted } from 'vue';


onMounted(() => {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start',
                });
            }
        });
    });
});
</script>

<template>
    <MyLayout>
        <div class="w-full md:px-[15rem] md:pt-20 ">
            <div class="bg-white w-full mb-10 md:pt-20 pt-10 px-10 border rounded-xl">
                <div id="top" class="flex items-center">
                    <img src="/svgs/logo2.svg" class="my-10 hidden md:block h-20" alt="" />
                    <p class="text-6xl font-bold text-gray-700">: HELP</p>
                </div>
                <div class="mt-5">
                    <p class="text-4xl font-bold text-gray-700">#Introduction</p>
                    <p class="text-xl mt-5">Welcome to Toro, the platform that helps you earn money by completing tasks
                        for our trusted
                        partners. This guide will walk you through every aspect of our application so you can maximize
                        your earning potential.</p>
                </div>
                <div class="mt-10">
                    <p class="text-4xl font-bold text-gray-700">#Table of content</p>
                    <ul class="text-xl underline pl-5">
                        <li>> <a href="#levels"> Levels </a></li>
                        <li>> <a href="#offers">Offers </a></li>
                        <li>> <a href="#tasks">Tasks </a></li>
                        <li>> <a href="#deposits">Deposits </a></li>
                        <li>> <a href="#withdrawals">Withdrawals </a></li>
                        <li>> <a href="#methods">Payment methods </a></li>
                        <li>> <a href="#contact">Contact Admin </a></li>
                        <li>> <a href="#bonus">Bonus</a></li>
                        <li>> <a href="#conclusion">Conclusion</a></li>
                    </ul>
                </div>
                <div id="levels" class="mt-10 text-lg">
                    <p class="text-4xl font-bold text-gray-700">#Levels</p>
                    <p class="text-xl mt-5 md:pl-5">Levels are the foundation of Toro. Each level determines:
                    </p>
                    <ul class="md:pl-10 mt-4">
                        <li>
                            <p>
                                <span>●</span>
                                <strong> Deposit Requirement:</strong> The amount you need to invest.
                            </p>
                                
                        </li>
                        <li>
                            <p>
                                <span>●</span>
                                <strong> Profit Percentage:</strong> a percentage of your deposit returned as profit
                                after task completion.                          
                             </p>
                           
                                
                           
                        </li>
                        <li>
                            <p>
                                <span>●</span>
                                <strong> Task Requirement:</strong> The minimum number of tasks you must complete to
                                qualify for profit.
                            </p>
                        </li>
                    </ul>
                    <p class="text-2xl md:pl-5 mt-5">Key Points:</p>
                    <ol class="md:pl-10 mt-4">
                        <li>
                            <strong>1. Subscription:</strong> To join a level, make the required deposit and complete
                            all tasks within the specified time.
                        </li>
                        <li>
                            <strong>2. Task Completion:</strong> If you miss 5 or more tasks, you forfeit your deposit
                            and profit.
                        </li>
                        <li>
                            <strong>3. Advanced Levels::</strong> Unlock higher levels by sharing your registration link
                            with others. Each referral must:
                            <ul class="mt-2 md:pl-5">
                                <li class="flex items-center">
                                    <div class="h-2 w-2 rounded-full mr-2 bg-slate-800"></div> Register using your link.
                                </li>
                                <li class="flex items-center">
                                    <div class="h-2 w-2 rounded-full mr-2 bg-slate-800"></div>Subscribe to at least one
                                    level.
                                </li>
                            </ul>
                        </li>
                    </ol>
                    <p class="text-2xl md:pl-5 mt-5  font-bold">Example :</p>
                    <ol class="md:pl-10 mt-4">
                        <li>
                            <strong>1. Level 1:</strong> Deposit $10, Profit 50%, Complete all tasks.
                        </li>
                        <li>
                            <strong>2. Level 2:</strong> Deposit $20, Profit 50%, do all tasks.
                        </li>
                    </ol>
                </div>
                <div id="offers" class="mt-10 text-lg">
                    <p class="text-4xl font-bold text-gray-700">#Offers</p>
                    <p class="text-xl md:mt-5 pl-5">Toro frequently provides special offers with:
                    </p>
                    <ul class="md:pl-10 mt-4">
                        <li>
                            <p>
                                <span>●</span>
                                
                                <strong> Higher Profit Margins:</strong> Earn a greater percentage on your deposit..
                            </p>
                        </li>
                        <li>
                            <p>
                                <span>●</span>
                                <strong> Shorter Periods:</strong> Complete fewer tasks over a shorter timeframe.
                            </p>
                        </li>
                    </ul>
                    <p class="text-xl mt-5 md:pl-5">These offers are limited-time opportunities and appear on your
                        dashboard. Stay alert for updates
                        to make the most of them!

                    </p>
                </div>
                <div id="tasks" class="mt-10 text-lg">
                    <p class="text-4xl font-bold text-gray-700">#Tasks</p>
                    <p class="text-xl mt-5 md:pl-5">Tasks are the core of Toro’s earning mechanism. Each task is designed
                        by our partners and tailored to their needs.
                    </p>
                    <p class="text-2xl md:pl-5 mt-5  font-bold">Completing Tasks :</p>
                    <ol class="md:pl-10 mt-4">
                        <li>
                            <strong>1. </strong> Access your task list on the dashboard.
                        </li>
                        <li>
                            <strong>2. </strong> Follow the instructions provided for each task.
                        </li>
                        <li>
                            <strong>3. </strong> Submit your work for approval.
                        </li>
                    </ol>
                    <p class="text-2xl md:pl-5 mt-5  font-bold">Task Completion Tips :</p>
                    <ol class="md:pl-10 mt-4">
                        <li>
                            <strong>1. </strong> Ensure accuracy and adhere to guidelines.
                        </li>
                        <li>
                            <strong>2. </strong> Submit tasks on time to avoid penalties.
                        </li>
                        <li>
                            <strong>3. </strong> Stay consistent to maximize your earnings.
                        </li>
                    </ol>
                </div>
                <div id="deposits" class="mt-10 text-lg">
                    <p class="text-4xl font-bold text-gray-700">#Deposits</p>
                    <p class="text-xl mt-5 md:pl-5">Deposits allow you to subscribe to levels and participate in Toro.
                    </p>
                    <p class="text-2xl md:pl-5 mt-5  font-bold">How It Works :</p>
                    <ol class="md:pl-10 mt-4">
                        <li>
                            <strong>1. </strong> Choose a level.
                        </li>
                        <li>
                            <strong>2. </strong>Make the required deposit using one of the accepted payment methods (see
                            Payment Methods).
                        </li>
                        <li>
                            <strong>3. </strong> Submit your subscription in Levels Ladder.
                        </li>
                    </ol>


                </div>
                <div id="withdrawals" class="mt-10 text-lg">
                    <p class="text-4xl font-bold text-gray-700">#Withdrawals</p>
                    <p class="text-xl mt-5 md:pl-5">Once you complete all tasks for your level within the given timeframe,
                        you can withdraw:
                    </p>
                    <ol class="md:pl-10 mt-4">
                        <li>
                            <strong>1. </strong> Your initial deposit.
                        </li>
                        <li>
                            <strong>2. </strong>Your profit based on the level's percentage.
                        </li>
                    </ol>
                    <p class="text-2xl md:pl-5 mt-5  font-bold">Withdrawal Process :</p>
                    <ol class="md:pl-10 mt-4">
                        <li>
                            <strong>1. </strong> click on the "Withdraw" button on your Statistics page.
                        </li>
                        <li>
                            <strong>2. </strong>Select your preferred payment method.
                        </li>
                        <li>
                            <strong>3. </strong> Enter the withdrawal amount..
                        </li>
                        <li>
                            <strong>4. </strong> Enter your destination's adress..
                        </li>
                        <li>
                            <strong>4. </strong> Submit your request. Withdrawals are processed when admin confirmation
                            (0days to 2 days).
                        </li>
                    </ol>

                </div>
                <div id="methods" class="mt-10 text-lg">
                    <p class="text-4xl font-bold text-gray-700">#Payment methods</p>
                    <p class="text-xl mt-5 md:pl-5">Toro supports multiple payment methods to ensure a seamless experience.
                    </p>
                    <p class="text-3xl mt-5 font-bold md:pl-5 mb-4">1-Example of Deposit using binance.</p>
                    <div class="md:pl-20">
                        <p class="text-2xl font-bold text-gray-900 mb-4">1 Open binance app and select Wallets section
                        </p>
                        <div class="mockup-phone ml-10">
                            <div class="camera"></div>
                            <div class="display w-80">
                                <img src="/imgs/guide/binance-1.PNG" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="md:pl-20 mt-5">
                        <p class="text-2xl font-bold text-gray-900 mb-4">2 Go to spot section and search for USDT </p>
                        <div class="mockup-phone ml-10">
                            <div class="camera"></div>
                            <div class="display w-80">
                                <img src="/imgs/guide/binance-2.PNG" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="md:pl-20 mt-5">
                        <p class="text-2xl font-bold text-gray-900 mb-4">3 Click withdraw </p>
                        <div class="mockup-phone ml-10">
                            <div class="camera"></div>
                            <div class="display w-80">
                                <img src="/imgs/guide/binance-3.PNG" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="md:pl-20 mt-5">
                        <p class="text-2xl font-bold text-gray-900 mb-4">4 Select send via Email/Phone/ID </p>
                        <div class="mockup-phone ml-10">
                            <div class="camera"></div>
                            <div class="display w-80">
                                <img src="/imgs/guide/binance-4.PNG" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="md:pl-20 mt-5">
                        <p class="text-2xl font-bold text-gray-900 mb-4">5 Enter the ID provided by the app and the
                            amount you wish to deposit and click send </p>
                        <div class="mockup-phone ml-10">
                            <div class="camera"></div>
                            <div class="display w-80">
                                <img src="/imgs/guide/binance-5.PNG" alt="">
                            </div>
                        </div>
                    </div>
                    <p class="text-3xl mt-5 font-bold md:pl-5 mb-4">2-Example of Deposit using bybit.</p>
                    <div class="md:pl-20">
                        <p class="text-2xl font-bold text-gray-900 mb-4">1 Open binance app and select Assets section
                            and click withdraw </p>
                        <div class="mockup-phone ml-10">
                            <div class="camera"></div>
                            <div class="display w-80">
                                <img src="/imgs/guide/bybit-1.PNG" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="md:pl-20 mt-5">
                        <p class="text-2xl font-bold text-gray-900 mb-4">2 Search for usdt </p>
                        <div class="mockup-phone ml-10">
                            <div class="camera"></div>
                            <div class="display w-80">
                                <img src="/imgs/guide/bybit-3.PNG" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="md:pl-20 mt-5">
                        <p class="text-2xl font-bold text-gray-900 mb-4">2 Enter the ID provided by the app and the
                            amount you wish to deposit and click send </p>
                        <div class="mockup-phone ml-10">
                            <div class="camera"></div>
                            <div class="display w-80">
                                <img src="/imgs/guide/bybit-4.PNG" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div id="contact" class="mt-10 text-lg">
                    <p class="text-4xl font-bold text-gray-700">#Contact Admin</p>
                    <p class="text-xl mt-5 md:pl-5">Need assistance? Our support team is here to help..</p>
                    <p class="text-3xl mt-5 font-bold md:pl-5 mb-4">1- Use the "Contact Admin" page on your dashboard to
                        Report issues.</p>
                    <div class="md:pl-20">
                        <div class="mockup-phone ml-10">
                            <div class="camera"></div>
                            <div class="display w-80 ">
                                <img src="/imgs/guide/contact_admin.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div id="bonus" class="mt-10 text-lg">
                    <p class="text-4xl font-bold text-gray-700">#Bonuse</p>
                    <p class="text-xl mt-5 md:pl-5">Toro rewards users who help grow the community.</p>
                    <p class="text-2xl md:pl-5 mt-5  font-bold">Referral Bonuses:</p>
                    <ol class="md:pl-10 mt-4">
                        <li>
                            <strong>1.</strong> Share your unique registration link with others.
                        </li>
                        <li>
                            <strong>2.</strong> Earn 10% of the referred user’s first level deposit.
                        </li>
                    </ol>
                    <p class="text-xl md:pl-5 mt-5  font-bold">Bonus Rules :</p>
                    <ol class="md:pl-10 mt-4">
                        <li>
                            <strong>1.</strong> Referrals must be active users (subscribe to a level at least once).
                        </li>
                        <li>
                            <strong>2.</strong> Bonuses are credited automatically after the referred user's deposit.
                        </li>
                    </ol>
                </div>
                <div id="conclusion" class="mt-10 mb-20 text-lg">
                    <p class="text-4xl font-bold text-gray-700">#Conclusion</p>
                    <p class="text-xl ml-5 mt-5 text-gray-700">Toro is your gateway to making money by completing tasks
                        and leveraging your network. By understanding the system, staying consistent, and taking
                        advantage of offers, you can unlock significant earning potential.

                        If you have any questions or face issues, don't hesitate to reach out via the "Contact Admin"
                        page. We're here to support your journey to financial growth.

                        Welcome aboard Toro—start earning today!</p>
                </div>
                <div class="mt-10">
                    <a href="#top" class="text-blue-500 underline text-xl">Back to Top</a>
                </div>
            </div>
            

        </div>
    </MyLayout>
</template>