from app.configurations.interfaces import ConfigurationsABC
from .text_vectorizer_configurations import TextVectorizerConfigurations
from .feature_selector_configurations import FeatureSelectorConfigurations
from .classification_model_configurations import ClassificationModelConfigurations


class MachineLearningConfigurations(ConfigurationsABC):
    TextVectorizers = TextVectorizerConfigurations
    FeatureSelectors = FeatureSelectorConfigurations
    ClassificationModels = ClassificationModelConfigurations
