import React from 'react';
import { renderToString } from 'react-dom/server';
import { Provider } from 'react-redux';
import { createStore } from 'redux';
import App from '../containers/App';
import reducer from '../reducers';

const preloadedState = window.__PRELOADED_STATE__; // eslint-disable-line no-underscore-dangle
const store = createStore(reducer, preloadedState);

global.serverSiderMarkup = renderToString(
  <Provider store={store}>
    <App />
  </Provider>,
);
