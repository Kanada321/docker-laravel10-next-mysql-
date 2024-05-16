// next.config.mjs
const nextConfig = {
    webpackDevMiddleware: config => {
        config.watchOptions = {
            poll: 1000, // ポーリング間隔（ミリ秒単位）
            aggregateTimeout: 300, // 変更を集約する時間（ミリ秒単位）
        };
        return config;
    },
};

export default nextConfig;
