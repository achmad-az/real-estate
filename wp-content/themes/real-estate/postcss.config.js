module.exports = {
    plugins: [
        require('postcss-import'), // Handles @import rules
        require('tailwindcss/nesting')(require('postcss-nesting')), // Handles nested rules
        require('tailwindcss'), // Tailwind CSS framework
        require('autoprefixer') // Adds vendor prefixes for compatibility
    ]
};