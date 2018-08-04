var path = require('path')
var webpack = require('webpack')
const ExtractTextPlugin = require("extract-text-webpack-plugin");


if (process.env.NODE_ENV == 'development') {
  var buildPublicPath = '/dist/';
} else {
  var buildPublicPath = '/wp-content/themes/VueTheme/dist/';
}


var sassExtract = [
  {
    loader: 'css-loader', 
    options: { importLoaders: 1 } // translates CSS into CommonJS modules
  }, {
    loader: 'sass-loader' // compiles Sass to CSS
  },
  {
    loader: 'sass-resources-loader',
    options: {
  
      resources: path.resolve(__dirname, './src/sass/resources/*.scss')
    }
  }];



var rules = {
    
    babel : {
      test: /\.js$/,
      loader: 'babel-loader',
      exclude: /node_modules/
    },

    files : {
      test: /\.(png|jpg|gif|svg|otf|eot|woff|ttf|eot?|woff2)$/,
      loader: 'file-loader',
      options: {
        name: '[name].[ext]?[hash]'
      }
    },


    sass : {
      test: /\.s[a|c]ss$/,
      use: ExtractTextPlugin.extract({
        use: sassExtract
      })
    },


    vue : {
      test: /\.vue$/,
      loader: 'vue-loader',
      options: {
        loaders: {
          scss: ExtractTextPlugin.extract({
            use: sassExtract,
            fallback: 'vue-style-loader'
          })
        }
      }
    }

}


module.exports = {
  name: 'app',
  entry: './src/main.js',
  output: {
    path: path.resolve(__dirname, './dist'),
    publicPath: buildPublicPath,
    filename: 'build.js?[hash]'
  },
  module: {
    rules: [
      rules.vue,
      rules.babel,
      rules.files,
      rules.sass
    ]
  },
  resolve: {
    alias: {
      'vue$': 'vue/dist/vue.esm.js'
    }
  },
  devServer: {
    historyApiFallback: true,
    noInfo: true,
    headers: {
      "Access-Control-Allow-Origin": "*",
      "Access-Control-Allow-Methods": "GET, POST, PUT, DELETE, PATCH, OPTIONS",
      "Access-Control-Allow-Headers": "X-Requested-With, content-type, Authorization"
    }
  },
  performance: {
    hints: false
  },
  devtool: '#eval-source-map',
  plugins: [
    new ExtractTextPlugin({
      filename: "build.css"
    })
  ]
}

if (process.env.NODE_ENV === 'production') {
  module.exports.devtool = '#source-map'
  // http://vue-loader.vuejs.org/en/workflow/production.html
  module.exports.plugins = (module.exports.plugins || []).concat([
    new webpack.DefinePlugin({
      'process.env': {
        NODE_ENV: '"production"'
      }
    }),
    new webpack.optimize.UglifyJsPlugin({
      sourceMap: true,
      compress: {
        warnings: false
      }
    }),
    new webpack.LoaderOptionsPlugin({
      minimize: true
    })
  ])
} else if(process.env.NODE_ENV === 'development') {
  module.exports.output.publicPath = 'http://localhost:8080'+module.exports.output.publicPath;
}
