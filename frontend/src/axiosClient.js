import axios from "axios";

// Lấy URL từ biến môi trường
const baseURL = import.meta.env.VITE_API_BASE_URL;

// Tạo instance Axios
const axiosClient = axios.create({
  baseURL, // Base URL từ file .env
  headers: {
    "Content-Type": "application/json",
  },
  withCredentials: true, // Add this line to include credentials in requests
});

// Xử lý request nếu cần
axiosClient.interceptors.request.use(
  (config) => {
    const tokenElement = document.querySelector('meta[name="csrf-token"]');
    if (tokenElement) {
      const token = tokenElement.getAttribute("content");
      if (token) {
        config.headers["X-CSRF-TOKEN"] = token;
      }
    }
    const authToken = localStorage.getItem("authToken");
    if (authToken) {
      config.headers["Authorization"] = `Bearer ${authToken}`;
    }
    return config;
  },
  (error) => {
    return Promise.reject(error);
  }
);

// Xử lý response nếu cần
axiosClient.interceptors.response.use(
  (response) => response,
  (error) => {
    // handleError('API Error:', error);
    console.error("API Error:", error);
    return Promise.reject(error);
  }
);

export default axiosClient;
