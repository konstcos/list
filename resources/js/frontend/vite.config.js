import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import { fileURLToPath, URL } from 'url';

// https://vitejs.dev/config/
export default defineConfig(({command}) => ({
  plugins: [vue()],
  root: '.',
  base: command === 'serve' ? '/' : '/dist/',
  build: {
    outDir: '../../../public/dist',
  },
  // resolve: {
  //   alias: {
  //     '@': fileURLToPath(new URL('./src', import.meta.url)),
  //   },
  // },
}))
