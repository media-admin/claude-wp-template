cat > vite.config.js << 'EOF'
import { defineConfig } from 'vite';
import liveReload from 'vite-plugin-live-reload';
import path from 'path';

export default defineConfig({
  plugins: [
    liveReload([
      'wp-content/themes/custom-theme/**/*.php',
    ]),
  ],
  
  build: {
    outDir: 'wp-content/themes/custom-theme/assets/dist',
    emptyOutDir: true,
    
    rollupOptions: {
      input: {
        main: path.resolve(__dirname, 'wp-content/themes/custom-theme/assets/src/js/main.js'),
        style: path.resolve(__dirname, 'wp-content/themes/custom-theme/assets/src/scss/style.scss'),
      },
      output: {
        entryFileNames: 'js/[name].js',
        chunkFileNames: 'js/[name].js',
        assetFileNames: (assetInfo) => {
          if (assetInfo.name.endsWith('.css')) {
            return 'css/[name][extname]';
          }
          if (/\.(png|jpe?g|svg|gif|webp)$/.test(assetInfo.name)) {
            return 'images/[name][extname]';
          }
          return 'assets/[name][extname]';
        }
      }
    },
    
    manifest: true,
    minify: 'terser',
  },
  
  server: {
    host: 'localhost',
    port: 3000,
    strictPort: true,
    cors: true,
  },
  
  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'wp-content/themes/custom-theme/assets/src'),
    }
  },
});
EOF