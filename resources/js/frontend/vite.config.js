import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

// https://vitejs.dev/config/
export default defineConfig(({command}) => ({
  plugins: [vue()],
  root: '.',
  base: command === 'serve' ? '/' : '/dist/',
  build: {
    outDir: '../../../public/dist',
  },
}))
