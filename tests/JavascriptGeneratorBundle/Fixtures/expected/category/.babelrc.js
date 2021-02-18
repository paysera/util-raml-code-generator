module.exports = (api) => {
    api.cache.forever();

    return {
        presets: [
            ['@babel/preset-env', { modules: false }],
        ],
        plugins: ['@babel/plugin-transform-runtime'],
    };
};
