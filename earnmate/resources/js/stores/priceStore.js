import { defineStore } from 'pinia';
import { ref } from 'vue';

export const usePriceStore = defineStore('price', () => {
  const price = ref(null); // The DZD price for the current day
  const lastFetchedDate = ref(null); // Date when the price was last fetched
  const loading = ref(false); // Loading state

  // Helper function to check if the date is today
  const isToday = (dateString) => {
    if (!dateString) return false;
    const today = new Date();
    const date = new Date(dateString);
    return (
      date.getFullYear() === today.getFullYear() &&
      date.getMonth() === today.getMonth() &&
      date.getDate() === today.getDate()
    );
  };

  // Action to fetch the DZD price
  const fetchPrice = async () => {
    if (isToday(lastFetchedDate.value)) {
      console.log('Price already fetched today.');
      return; // Skip fetching if already fetched today
    }

    loading.value = true;
    try {
      const response = await fetch('https://v6.exchangerate-api.com/v6/46f2bf6cd33a88da3966d7f3/latest/USD');
      const data = await response.json();
      price.value = data.conversion_rates.DZD + 100; // Assuming API returns { price: 123.45 }
      lastFetchedDate.value = new Date().toISOString(); // Update the last fetched date
    } catch (error) {
      console.error('Error fetching DZD price:', error);
    } finally {
      loading.value = false;
    }
  };

  return {
    price,
    lastFetchedDate,
    loading,
    fetchPrice,
  };
});