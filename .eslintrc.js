module.exports = {
    'env': {
        'amd': true,
        'browser': true,
        'es2021': true,
        'node': true
    },
    'extends': [
        'eslint:recommended',
        'plugin:vue/recommended'
    ],
    'parserOptions': {
        'ecmaVersion': 12,
        'sourceType': 'module'
    },
    'plugins': ['vue'],
    'rules': {
        'eol-last': ['error', 'always'],
        'indent': ['error', 4],
        'no-multi-spaces': ['error'],
        'quotes': ['error', 'single'],
        'semi': ['error', 'always', { 'omitLastInOneLineBlock': true }],
        'vue/html-indent': ['error', 4],
        'vue/html-quotes': ['error', 'double', { 'avoidEscape': true }],
        'vue/max-attributes-per-line': ['error', { 'singleline': { 'max': 99 }, 'multiline': { 'max': 1 } }],
    }
};
