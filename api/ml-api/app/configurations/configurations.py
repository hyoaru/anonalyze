from .interfaces import ConfigurationsABC
from .machine_learning_model_configurations import MachineLearningModelConfigurations
from .feature_selector_configurations import FeatureSelectorConfigurations
from .text_vectorizer_configurations import TextVectorizerConfigurations


class Configurations(ConfigurationsABC):
    # App Configurations

    MachineLearningModels = MachineLearningModelConfigurations
    TextVectorizers = TextVectorizerConfigurations
    FeatureSelectors = FeatureSelectorConfigurations
