const emailRegex =
  /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
const passwordRegex =
  /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/;

const validator = (options) => {
  const selectorRules = {};
  const validate = (inputElement, rule) => {
    const errorElement = inputElement.parentElement.querySelector(
      options.errorSelector
    );
    let errorMessage;
    const rules = selectorRules[rule.selector];
    for (let i = 0; i < rules.length; i++) {
      errorMessage = rules[i](inputElement.value);
      if (errorMessage) break;
    }
    if (errorMessage) {
      errorElement.innerText = errorMessage;
      inputElement.parentElement.classList.add("invalid");
    } else {
      errorElement.innerText = "";
      inputElement.parentElement.classList.remove("invalid");
    }
    return !errorMessage;
  };
  const formElement = document.querySelector(options.form);
  if (formElement) {
    formElement.onsubmit = (e) => {
      let isFormValid = true;
      options.rules.forEach((rule) => {
        const inputElement = formElement.querySelector(rule.selector);
        const isValid = validate(inputElement, rule);
        if (!isValid) {
          isFormValid = false;
        }
      });
      if (isFormValid) {
        return;
      } else {
        e.preventDefault();
      }
    };
  }
  if (formElement) {
    options.rules.forEach((rule) => {
      if (Array.isArray(selectorRules[rule.selector])) {
        selectorRules[rule.selector].push(rule.test);
      } else {
        selectorRules[rule.selector] = [rule.test];
      }
      const inputElement = formElement.querySelector(rule.selector);

      if (inputElement) {
        inputElement.onblur = () => {
          validate(inputElement, rule);
        };

        inputElement.oninput = () => {
          const errorElement = inputElement.parentElement.querySelector(
            options.errorSelector
          );
          errorElement.innerText = "";
          inputElement.parentElement.classList.remove("invalid");
        };
      }
    });
  }
};

validator.isRequire = (selector) => {
  return {
    selector,
    test: (value) => {
      return value.trim() ? undefined : "This a required field";
    },
  };
};

validator.isEmail = (selector) => {
  return {
    selector,
    test: (value) => {
      return emailRegex.test(value) ? undefined : "Invalid email";
    },
  };
};

validator.isPassword = (selector) => {
  return {
    selector,
    test: (value) => {
      if (value.length < 8) {
        return "Minimum eight characters";
      }
      return passwordRegex.test(value)
        ? undefined
        : "At least one uppercase letter, one lowercase letter, one number and one special character";
    },
  };
};

validator.confirmPassword = (selector) => {
  return {
    selector,
    test: (value) => {
      return document.querySelector("#form-1 #password").value === value
        ? undefined
        : "Password must be same";
    },
  };
};
