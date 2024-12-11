import globals from 'globals';
import js from '@eslint/js';
import vue from 'eslint-plugin-vue';

export default [
    js.configs.recommended,
    ...vue.configs['flat/vue2-strongly-recommended'],
    {
        files: ['**/*.js', '**/*.vue'],
        plugins: { vue: vue },
        languageOptions: {
            ecmaVersion: 12,
            sourceType: 'module',
            globals: {
                ...globals.amd,
                ...globals.browser,
                ...globals.commonjs,
                ...globals.es2021,
                '$': 'readable',
                '__dirname': 'readable',
                'Bus': 'readable',
                'TruvBridge': 'readable',
                'process': 'readable',
                'stripe': 'readable',
                'Spark': 'readable',
                'SparkForm': 'readable',
                'Vue': 'readable'
            }
        },
        rules: {
            'eol-last': ['error', 'always'],
            'indent': ['error', 4, { 'SwitchCase': 1 }],
            'no-console': ['error', { allow: ['warn', 'error'] }],
            'no-multi-spaces': ['error'],
            'padding-line-between-statements': [
                'error',
                { blankLine: 'always', prev: '*', next: 'return' },
                { blankLine: 'always', prev: ['const', 'let', 'var'], next: '*' },
                { blankLine: 'any', prev: ['const', 'let', 'var'], next: ['const', 'let', 'var'] },
                { blankLine: 'always', prev: ['case', 'default'], next: '*' },
                { blankLine: 'always', prev: 'if', next: '*' },
                { blankLine: 'always', prev: '*', next: 'if' }
            ],
            'quotes': ['error', 'single'],
            'semi': ['error', 'always', { 'omitLastInOneLineBlock': true }],
            'vue/html-indent': ['error', 4],
            'vue/html-quotes': ['error', 'double', { 'avoidEscape': true }],
            'vue/max-attributes-per-line': ['error', { 'singleline': { 'max': 99 }, 'multiline': { 'max': 1 } }],
            'vue/multi-word-component-names': ['error', {
                'ignores': [
                    'Addresses', 'Agreements', 'Bankruptcy', 'Card', 'Docs', 'Drug',
                    'Education', 'Employment', 'Index', 'File', 'Home', 'Judgment',
                    'Lien', 'List', 'Logs', 'Medical', 'Modal', 'Note',
                    'Notifications', 'Order', 'Review', 'Sidebar', 'Accordion'
                ]
            }],
            'vue/prop-name-casing': ['error', 'camelCase'],
            'vue/require-prop-types': ['error']
        }
    }
];
