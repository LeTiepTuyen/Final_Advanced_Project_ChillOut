import axios from "axios";
import { useRouter } from "vue-router";

// Lấy URL từ biến môi trường
const baseURL = import.meta.env.VITE_API_BASE_URL;

// Tạo instance Axios
const axiosClient = axios.create({
  baseURL, // Base URL từ file .env
  headers: {
    "Content-Type": "application/json",
  },
  withCredentials: true, // Bao gồm cookie trong request nếu cần
});

// Hàm để lấy CSRF token trước khi thực hiện các POST/PUT/DELETE request
const getCsrfToken = async () => {
  try {
    await axiosClient.get("/sanctum/csrf-cookie");
    console.log("CSRF cookie set successfully.");
  } catch (error) {
    console.error("Failed to set CSRF cookie:", error);
    throw error;
  }
};

// Xử lý request trước khi gửi
axiosClient.interceptors.request.use(
  async (config) => {
    // Đảm bảo CSRF cookie được thiết lập
    if (["post", "put", "delete"].includes(config.method)) {
      await getCsrfToken();
    }

    // Lấy CSRF token từ meta tag (logic cũ)
    const tokenElement = document.querySelector('meta[name="csrf-token"]');
    if (tokenElement) {
      const token = tokenElement.getAttribute("content");
      if (token) {
        config.headers["X-CSRF-TOKEN"] = token; // Thêm X-CSRF-TOKEN từ meta tag nếu có
      }
    }

    // Lấy Authorization token từ localStorage
    const authToken = localStorage.getItem("authToken");
    if (authToken) {
      config.headers["Authorization"] = `Bearer ${authToken}`; // Thêm Authorization header với Bearer token
    }

    console.log("Sending request to:", config.url); // Ghi log URL request
    return config;
  },
  (error) => {
    console.error("Request error:", error); // Ghi log lỗi request
    return Promise.reject(error);
  }
);

// Xử lý response trả về từ server
axiosClient.interceptors.response.use(
  (response) => response, // Trả về response nếu không có lỗi
  (error) => {
    const router = useRouter();
    if (error.response) {
      if (error.response.status === 401) {
        console.warn("Unauthorized. Removing token and redirecting to auth page...");
        localStorage.removeItem("authToken");
        router.push("/auth");
      }

      if (error.response.status === 404) {
        router.push("/404");
      }
    }
    return Promise.reject(error);
  }
);

export default axiosClient;
