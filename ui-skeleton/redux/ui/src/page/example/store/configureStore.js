import { createStore, applyMiddleware, compose } from 'redux';
import thunkMiddleware from 'redux-thunk';
import createLogger from 'redux-logger';
import rootReducer from '../reducers';

export default function configureStore(preloadedState) {
  const store = createStore(
      rootReducer,
      preloadedState,
      compose(
          applyMiddleware(thunkMiddleware, createLogger()),
          /* eslint-disable no-undef */
          window.devToolsExtension ? window.devToolsExtension() : f => f,
          /* eslint-enable no-undef */
      ),
  );
  if (module.hot) {
    // Enable Webpack hot module replacement for reducers
    module.hot.accept('../reducers', () => {
      const nextReducer = require('../reducers').default; // eslint-disable-line global-require
      store.replaceReducer(nextReducer);
    });
  }
  return store;
}

