import axios from 'axios';

// Lấy URL từ biến môi trường
const baseURL = import.meta.env.VITE_API_BASE_URL;

// Tạo instance Axios
const axiosClient = axios.create({
    baseURL, // Base URL từ file .env
    headers: {
        'Content-Type': 'application/json',
    },
});

// Xử lý request nếu cần
axiosClient.interceptors.request.use((config) => {
    // Thêm token hoặc cấu hình khác vào header
    // config.headers.Authorization = `Bearer ${token}`;
    return config;
});

// Xử lý response nếu cần
axiosClient.interceptors.response.use(
    (response) => response,
    (error) => {
        console.error('API Error:', error);
        return Promise.reject(error);
    }
);

export default axiosClient;
