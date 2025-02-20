import axiosClient from '@/axios';
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
      return;
    }

    loading.value = true;
    try {
      const response = await axiosClient.get('/dzd-price');
      const data =   response.data;
      price.value = data.price; // Assuming API returns { price: 123.45 }
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